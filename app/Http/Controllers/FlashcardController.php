<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;
use App\Models\Topic;
use App\Models\Deck;
use App\Models\Flashcard;

class FlashcardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dcks = auth()->user()->decks()->latest()->get();

        return view ('flashcards', [
            'xfc' => $dcks,
            'xside' => $dcks,
            'xowns' => true,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        // dd($id);
        $dck = Deck::find($id);
        return view('flashcard_new', compact('dck'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:4000',
            'answer' => 'required|string|max:4000',
        ]);

        $fc = new Flashcard();
        $fc->question = $request->question;
        $fc->answer = $request->answer;
        $fc->deck_id = $request->dck_id;
        $fc->save();

        return redirect()->route('flashcards.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $belongsToUser=false;

        // check if deck belongs to user
        if(auth()->check()){
            $deck = Deck::findOrFail($id);
            $belongsToUser = $deck->topic->user->id === auth()->user()->id;
            
            // $bel= (auth()->user()->topics()->whereHas('decks', function ($query) use ($deck) {
            //     $query->where('id', $deck->id);
            // })->exists());

            // dd($bel);
        }
       

        if($belongsToUser){
            $dcks = auth()->user()->decks()->latest()->get();
            $fc = auth()->user()->decks()->find($id);

            return view ('flashcards', [
                'xfc' => compact('fc'),
                'xside' => $dcks,
                'xowns'=>true,
            ]);

        }else{

            $fc = Deck::findOrFail($id);
            $allDecks = $fc->topic->decks;

            return view ('flashcards', [
                'xfc' => compact('fc'),
                'xside' => $allDecks,
                'xowns'=>false,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fc = Flashcard::findOrFail($id);
        return view('flashcard_edit', ['fc'=>$fc]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $f = Flashcard::findOrFail($id);

        if($request->ajax()){
            $f->times_answered = $request->r_times_answered;
            $f->times_viewed = $request->r_times_viewed;
            $f->last_answer = $request->r_last_answer;
            $f->last_viewed = now()->toDateTimeString();
            $f->save();

            return response()->json(['status' => 'success', 'message' => 'Updated successfully'], 200);
        }
        else{
            $f->question = $request->question;
            $f->answer = $request->answer;
            $f->times_viewed = $request->times_viewed;
            $f->last_answer = $request->last_answer;
            $f->last_viewed = $request->last_viewed;
            $f->save();

            return redirect()->route('flashcards.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fc = Flashcard::findOrFail($id);
        $fc->delete();

        // return redirect()->route('flashcards.index');
        return redirect()->back();
    }
}
