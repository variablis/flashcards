<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $c = Category::with(['topics.decks.flashcards'])->latest()->get();
        $sums = (object) [
            'topics_sum' => 0,
            'decks_sum' => 0,
            'fc_sum' => 0
        ];

        foreach ($c as $catel) {
            $catel->topics_cnt = $catel->topics->count();
            $sums->topics_sum += $catel->topics_cnt;

            $catel->decks_cnt = $catel->decks->count();
            $sums->decks_sum += $catel->decks_cnt;

            $catel->fc_cnt = $catel->topics->flatMap(function ($topic) {
                return $topic->decks->flatMap(function ($deck) {
                    return $deck->flashcards;
                });
            })->count();
            $sums->fc_sum += $catel->fc_cnt;

        }

        return view('admin.categories', ['cat' => $c, 'stats' => $sums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category_new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $c = new Category();

        $validated = $request->validate([
            'name' => 'required|unique:categories|string|max:255',
        ]);

        $c->name = $validated['name'];
        $c->save();
 
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $c = Category::findOrFail($id);

        return view('admin.category_edit', ['cat' => $c]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $c = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $c->id,
        ]);

        $c->name = $validated['name'];
        $c->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $c = Category::findOrFail($id);
        $c->delete();

        return redirect()->route('categories.index');
    }
}
