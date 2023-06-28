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
    public function copy(string $id)
    {
        return $id;
    }

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
        ])->latest()->get();

        // dd($uu);

        return view ('decks', [
            'xtest' => $uu,
            'xside' => $uu,
            'xowns' =>true,
        ]);  
    }

    public function explore(): View
    {
        // if(Gate::allows('is-admin')){
        //     echo 'admins';
        // }

        $topics = Topic::filter(request(['search']))
        ->where('is_public', true)
        ->with('decks')
        ->get();

        $decks1 = $topics->flatMap(function ($topic) {
            return $topic->decks;
        });

        $decks = Deck::filter(request(['search']))
        ->whereRelation('topic', 'is_public', true)
        ->get();

        $decks = $decks->concat($decks1);
        $groupedDecks = $decks->groupBy([
            'topic.category.id',
            'topic.id'
        ]);


        // dd($groupedDecks);

        $groupedDecks = $groupedDecks->map(function ($group) {
            return $group->take(5);
        });


        $s=request()->input('search');
    
        return view ('explore', [
            'xcat'=> $groupedDecks,
            'srch' => $s,
            'cnt' => $decks->count() //for search results
        ]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $tpc = Topic::find($id);
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
        // $t =Topic::findOrFail($id);

        // dd($t);
        // if (Gate::allows('is-owner', [auth()->user(), $t])) {
        //     echo 'owneris';
        // }

        $belongsToUser=false;

        // check if deck belongs to user
        if(auth()->check()){
            $topic = Topic::findOrFail($id);
            $belongsToUser = $topic->user_id === auth()->user()->id;
        }

        if($belongsToUser){

            $tpcs = Topic::whereBelongsTo(auth()->user())->latest()->get();
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
                'xowns' =>true,
            ]);

        }else{
            $topic = Topic::findOrFail($id);
            $allTopics=$topic->category->topics->where('is_public', true);
            return view ('decks', [
                'xtest' => compact('topic'),
                // 'xtest' => $topic,
                'xside' => $allTopics,
                'xowns' =>false,
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
