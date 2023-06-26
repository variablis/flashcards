<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;

use App\Models\Topic;
use App\Models\Category;
// use App\Models\User;

class TopicController extends Controller
{
    public function copy(string $id)
    {   
        // Find the original topic by ID with its relationships
        $originalTopic = Topic::with('category', 'decks.flashcards')->findOrFail($id);

        // Replicate the original topic
        $copiedTopic = $originalTopic->replicate();

        // Save the copied topic with the associated user
        $copiedTopic->user_id = auth()->id();
        $copiedTopic->save();

        // // Replicate the category relationship
        // $copiedCategory = $originalTopic->category->replicate();
        // $copiedCategory->save();

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
     * Display a listing of the resource.
     */

    public function index()
    {
        // dd($posts = User::find(1)->topics);
        // dd(Topic::with('user')->where('user_id', 1)->get());
        // dd(Category::find(1));


        // return view ('topics', [
        //     // 'xtopics' => Topic::where('user_id', $id)->latest()->get(),
        //     'xtopics' => Topic::whereBelongsTo(auth()->user())->get(),
        //     'cc' => Category::all(),
        // ]);

        // dd(auth()->guest());

        // return view ('welcome', [
        //     'xcat' => Category::all(),
        //     'xtopics' => Topic::all(),
        // ]);
    }

    public function indexCategory(string $id)
    {
        $cat = Category::findOrFail($id);
        $tpcs = $cat->topics()->where('is_public', true)->paginate(10);

        return view ('topics', [
            'xtopics' => $tpcs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
 
        $request->user()->topics()->create($validated);
 
        return redirect(route('topics.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tpc = Topic::findOrFail($id);
        return view ('topic', [
            'xtopics' => compact('tpc'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
