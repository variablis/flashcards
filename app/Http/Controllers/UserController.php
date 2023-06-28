<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\User;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {
            $u = $user->topics()->withCount(['decks', 'flashcards'])->get();
            $user->topicCount = $user->topics()->count();
            $user->deckCount = $u->sum('decks_count');
            $user->flashcardCount = $u->sum('flashcards_count');
            $user->banned = $user->is_banned;
        }

        return view('admin.admin', ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
