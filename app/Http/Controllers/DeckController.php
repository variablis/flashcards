<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

// use App\Models\User;
use App\Models\Category;
use App\Models\Topic;
use App\Models\Deck;
use App\Models\Flashcard;
use Illuminate\Support\Facades\Gate;

use Illuminate\Database\Eloquent\Builder;


class DeckController extends Controller
{
    public function test(string $id)
    {
        $tp = Topic::findOrFail($id);
        $decks = Deck::whereBelongsTo($tp)->get();
        $cards = Flashcard::whereBelongsTo($decks)->get();

        return view ('decks_test', [
            'xdata' => $cards->shuffle(),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $uu = auth()->user()->topics()->withCount([
            'decks', 
            'flashcards',
            'flashcards as flashcards_to_learn' => function (Builder $query) {
                $query->where('last_viewed', '<', now()->subDays(3))
                ->orWhere('last_answer','=', false);
            }
        ])->get();

        return view ('decks', [
            'xtest' => $uu,
            'xside' => $uu,
        ]);
       
    }

    public function explore(): View
    {
        // $tt = Deck::myTest(14)->get();
        // dd($tt);

        if(Gate::allows('is-admin')){
            echo 'admins';
        }

        $decks = Deck::filter(request(['search']))
        ->with('topic.category')
        ->get();

        // $am=array();
        // foreach($decks as $deck){
        //     $t=$deck->topic;
        //     $c=$t->category;
        //     $am[$deck->title][]=$t->toArray();
        // }
        
        // return view ('welcome', [
        //     'xcat' => $am,
        // ]);

        // dd($am['Deck dolorem']);
        // foreach ( $am as $category => $topics ) {
        //     foreach ($topics as $t) {
        //         // dd($t['title']);
        //     }
        // }
        // Category::all()

        // $grouped = $decks->groupBy('topic');

        // dd($decks->pluck('topic')->unique());

        $groupedDecks = $decks->groupBy([
            'topic.category.id',
            'topic.id'
        ]);
        // dd($groupedDecks);

        $s=request()->input('search');
    

        return view ('explore', [
            // 'xcat' => $decks->pluck('topic')->unique(),
            'xcat'=> $groupedDecks,
            'srch' => $s
        ]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $tpc = Topic::find($id)->first();
        return view('deck_new', compact('tpc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $deck = new Deck();
        $deck->title = $request->dck_title;
        $deck->description = $request->dck_description;
        $deck->topic_id = $request->tpc_id;
        $deck->save();

        $action = action([DeckController::class, 'index']);
        return redirect($action);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $belongsToUser=false;
        // $topic = Topic::findOrFail($id);
        // check if deck belongs to user
        if(auth()->check()){
            // $belongsToUser = auth()->user()->topics()
            //     ->whereHas('decks', function ($query) use ($id) {
            //         $query->where('id', $id);
            //     })
            //     ->exists();

            
            $topic = Topic::findOrFail($id);

            $belongsToUser = $topic->user_id === auth()->user()->id;

           // dd($dck->topic);
            // dd(auth()->user()->id);
        }

        if($belongsToUser){

            $tpcs = Topic::whereBelongsTo(auth()->user())->get();
            $uu = auth()->user()->topics()->where('id', $id)->withCount([
                'decks', 
                'flashcards',
                'flashcards as flashcards_to_learn' => function (Builder $query) {
                    $query->where('last_viewed', '<', now()->subDays(3))
                    ->orWhere('last_answer','=', false);
                }
            ])->get();

            return view ('decks', [
                'xtest' => $uu,
                'xside' => $tpcs,
            ]);

        }else{ 
            
            $topic = Topic::findOrFail($id);
            return view ('decks', [
                'xtest' => compact('topic'),
                'xside' => $topic->category->topics,
            ]);

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dck = Deck::findOrFail($id);
        return view('deck_edit', ['deck'=>$dck]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dck = Deck::findOrFail($id);
        $dck->delete();
        return redirect(action([DeckController::class, 'index']));
    }
}
