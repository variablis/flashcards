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
        $users = User::paginate(15);

        foreach ($users as $user) {
            $u = $user->topics()->withCount(['decks', 'flashcards'])->get();
            $user->topicCount = $user->topics()->count();
            $user->deckCount = $u->sum('decks_count');
            $user->flashcardCount = $u->sum('flashcards_count');
            $user->admin = $user->is_admin;
            $user->banned = $user->is_banned;
        }

        return view('admin.users', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $u = User::findOrFail($id);

        return view('admin.user_edit', ['usr' => $u]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $u = User::findOrFail($id);
        $u->name = $request->name;
        $u->email = $request->email;
        $u->is_admin = $request->is_admin? 1:0;
        $u->is_banned = $request->is_banned? 1:0;
        $u->save();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $u = User::findOrFail($id);
        $u->delete();

        return redirect()->route('users.index');
    }
}
