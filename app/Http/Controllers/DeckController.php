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
        $tpcs = Topic::whereBelongsTo(auth()->user())->get();
        // $dcks = Deck::whereBelongsTo($tpcs)->get();

        $topicsWithDecks = $tpcs->map(function ($topic) {
            $decks = Deck::whereBelongsTo($topic)->get();
            return [
                'topic' => $topic,
                'decks' => $decks,
            ];
        });

        // dd($topicsWithDecks);

        return view ('decks', [
            'xdata' => $topicsWithDecks,
            'xtopics' => $tpcs,
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
        $tpcs = Topic::whereBelongsTo(auth()->user())->get();
        
        $tp = Topic::findOrFail($id);

        // dd(Deck::whereBelongsTo($tp)->get());

        $topicsWithDecks = collect([$tp])->map(function ($topic) {
            $decks = Deck::whereBelongsTo($topic)->get();
            return [
                'topic' => $topic,
                'decks' => $decks,
            ];
        });

        // dd($topicsWithDecks);

        return view ('decks', [
            'xdata' => $topicsWithDecks,
            'xtopics' => $tpcs,
        ]);
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
