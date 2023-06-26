<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {
            $xx=$user->topics()->withCount(['decks', 'flashcards'])->get();
            $user->topicCount = $user->topics()->count();
            $user->deckCount = $xx->sum('decks_count');

            $user->flashcardCount = $xx->sum('flashcards_count');
        }

        return view('admin', ['users'=>$users]);
    }
}
