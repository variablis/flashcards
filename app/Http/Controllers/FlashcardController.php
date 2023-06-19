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
        $tpcs = Topic::whereBelongsTo(auth()->user())->get();
        $dcks = Deck::whereBelongsTo($tpcs)->get();

        return view ('flashcards', [
            // 'xtopics' => Topic::where('user_id', $id)->latest()->get(),
            'xfc' => Flashcard::whereBelongsTo($dcks)->get(),
            'xtopics' => $dcks,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
