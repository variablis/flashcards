<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Topic;
use App\Models\Deck;
use App\Models\Flashcard;
use Illuminate\Support\Facades\Gate;

use Illuminate\Database\Eloquent\Builder;


class DeckController extends Controller
{

    /**
     * Create a copy of resource.
     */
    public function copy(string $id, string $tid)
    {
        // Find the original topic by ID with its relationships
        $originalDeck = Deck::with('flashcards')->findOrFail($id);

        // Replicate the original topic
        $copiedDeck = $originalDeck->replicate();

        // Save the copied topic with the associated user
        $copiedDeck->topic_id = $tid;
        $copiedDeck->save();

        // Replicate the flashcards relationship
        foreach ($originalDeck->flashcards as $originalFlashcard) {
            $copiedFlashcard = $originalFlashcard->replicate();
            $copiedFlashcard->deck_id = $copiedDeck->id;
            $copiedFlashcard->save();
        }

        // return redirect()->route('decks.index');
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
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

    /**
     * Display a public list of the resource.
     */
    public function explore()
    {
        $topics = Topic::where('is_public', true)
        ->filter(request(['search']))
        ->filterCat(request('category'))
        ->with('decks')
        ->get();

        $decks = Deck::whereRelation('topic', 'is_public', true)
        ->filter(request(['search']))
        ->filterCat(request('category'))
        ->get();

        $sres = 0 + count($topics) + count($decks); 

        $decks1 = $topics->flatMap(function ($t) {
            return $t->decks;
        });

        $decks = $decks->merge($decks1);

        // if(request('category')){
        //     $decks = $decks->whereIn('topic.category.id', request('category'));
        // }

        $groupedDecks = $decks->groupBy([
            'topic.category.id',
            'topic.id'
        ]);


        // dd($groupedDecks);

        // $groupedDecks = $groupedDecks->map(function ($group) {
        //     return $group;
        // });

        // dd($groupedDecks);

        $s=request()->input('search');
    
        return view ('explore', [
            'xcat' => $groupedDecks,
            'srch' => $s,
            'cnt' => $sres, //for search results
            'allcat' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id=null)
    {
        if($id){
            $t = Topic::find($id);
            return view('deck_new', ['t' => $t, 'many' => 0]);
        }
        else{
            $t = Topic::where('user_id', auth()->user()->id)->get();
            return view('deck_new', ['t' => $t, 'many' => 1]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'topic_id' => 'required'
        ]);

        $d = new Deck();
        $d->title = $request->title;
        $d->description = $request->description;
        $d->topic_id = $request->topic_id;
        $d->save();

        return redirect()->route('decks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        $d = Deck::findOrFail($id);
        $t = auth()->user()->topics;

        return view('deck_edit', ['deck' => $d, 'topics' => $t]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $d = Deck::findOrFail($id);
        $d->title = $request->title;
        $d->description = $request->description;
        $d->topic_id = $request->topic_id;
        $d->save();

        return redirect()->route('decks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $d = Deck::findOrFail($id);
        $d->delete();

        // return redirect()->route('decks.index');
        return redirect()->back();
    }
}
