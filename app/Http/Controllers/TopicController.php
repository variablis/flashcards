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
