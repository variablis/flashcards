<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\View;
use App\Models\Topic;
use App\Models\Deck;
use App\Models\Flashcard;

class FlashcardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $tpcs = Topic::whereBelongsTo(auth()->user())->get();
        // $dcks = Deck::whereBelongsTo($tpcs)->get();

        $dcks = auth()->user()->decks()->get();

        return view ('flashcards', [
            // 'xfc' => Flashcard::whereBelongsTo($dcks)->get(),
            'xfc' => $dcks,
            'xside' => $dcks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $dck = Deck::find($id)->first();
        return view('flashcard_new', compact('dck'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fc = new Flashcard();
        $fc->question = $request->fc_question;
        $fc->answer = $request->fc_answer;
        $fc->deck_id = $request->dck_id;
        $fc->save();

        $action = action([FlashcardController::class, 'index']);
        return redirect($action);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(auth()->check()){
            $dcks = auth()->user()->decks()->get();
            $fc = auth()->user()->decks()->find($id);

            return view ('flashcards', [
                'xfc' => compact('fc'),
                'xside' => $dcks,
            ]);
        }else{

            $fc = Deck::findOrFail($id);;
            return view ('flashcards', [
                'xfc' => compact('fc'),
            ]);
        }
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
        $f = Flashcard::findOrFail($id);
        $f->times_answered = $request->r_times_answered;
        $f->times_viewed = $request->r_times_viewed;
        $f->last_answer = $request->r_last_answer;
        $f->last_viewed = now()->toDateTimeString();
        $f->save();
        // return $id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
