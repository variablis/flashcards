<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Topic;
use App\Models\Deck;

class TopicController extends Controller
{
    /**
     * Create a copy of resource.
     */
    public function copy(string $id)
    {   
        // Find the original topic by ID with its relationships
        $originalTopic = Topic::with('category', 'decks.flashcards')->findOrFail($id);

        // Replicate the original topic
        $copiedTopic = $originalTopic->replicate();

        // Save the copied topic with the associated user
        $copiedTopic->user_id = auth()->id();
        $copiedTopic->save();

        // Associate the copied category with the copied topic
        $copiedTopic->category()->associate($originalTopic->category);
        $copiedTopic->save();

        // Replicate the decks relationship
        foreach ($originalTopic->decks as $originalDeck) {
            $copiedDeck = $originalDeck->replicate();
            $copiedDeck->topic_id = $copiedTopic->id;
            $copiedDeck->save();

            // Replicate the flashcards relationship
            foreach ($originalDeck->flashcards as $originalFlashcard) {
                $copiedFlashcard = $originalFlashcard->replicate();
                $copiedFlashcard->deck_id = $copiedDeck->id;
                $copiedFlashcard->save();
            }
        }

        return redirect()->route('decks.index');
    }

    /**
     * Display a flashcard learning test view.
     */
    public function test(string $id)
    {
        $topic = Topic::with('decks.flashcards')->findOrFail($id);

        return view('topic_test', [
            'xdata' => $topic->decks->flatMap(function ($deck) {
                return $deck->flashcards;
            })->shuffle(),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $t = Topic::with('decks.flashcards')->paginate(15);
        return view('admin.topics', ['topics' => $t]);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexUser(string $id)
    {
        $t = Topic::with('decks.flashcards')->where('user_id', $id)->paginate(15);
        return view('admin.topics', ['topics' => $t]);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexCategory(string $id)
    {
        $c = Category::findOrFail($id);
        $t = $c->topics()->where('is_public', true)->latest()->paginate(15);

        return view('topics', ['xtopics' => $t]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $c = Category::all();
        return view('topic_new', ['cat' => $c]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string|max:255',
            'category_id' => 'required',
        ]);
 
        $data = [
            ...$validated,
            'is_public' => $request->is_public? 1:0
        ];

        $request->user()->topics()->create($data);
 
        return redirect()->route('decks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $t = Topic::findOrFail($id);
        return view ('topic', ['xtopics' => compact('t')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $t = Topic::findOrFail($id);
        $c = Category::all();
        return view('topic_edit', ['topic' => $t, 'cat' => $c]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $t = Topic::findOrFail($id);
        $t->title = $request->title;
        $t->description = $request->description;
        $t->category_id = $request->category_id;
        $t->is_public = $request->is_public? 1:0;
        $t->save();

        if($request->ajax()){
            return response()->json(['status' => 'success', 'message' => 'Updated successfully'], 200);
        }else{
            return redirect()->route('decks.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tpc = Topic::findOrFail($id);
        $tpc->delete();
        // return redirect()->route('decks.index');
        return redirect()->back();
    }
}
