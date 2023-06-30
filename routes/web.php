<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TopicController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\FlashcardController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [DeckController::class, 'explore'])->name('expl');

Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'lv'])) {        
        abort(404);
    }
    App::setLocale($locale);
    // Session
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang');


// topics
Route::resource('topics', TopicController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

Route::get('topics/copy/{id}', [TopicController::class, 'copy'])->name('topic.copy')->middleware(['auth']);
Route::get('topics/test/{id}', [TopicController::class, 'test'])->name('topic.test')->middleware(['auth']);
Route::get('explore/topics/{id}', [TopicController::class, 'indexCategory'])->name('expl.topics.indexCategory');


// decks
Route::resource('decks', DeckController::class)
    ->only(['index', 'show','store', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

Route::get('decks/create/{id?}', [DeckController::class, 'create'])->name('deck.create')->middleware(['auth']);
Route::get('decks/copy/{id}/{tid}', [DeckController::class, 'copy'])->name('deck.copy')->middleware(['auth']);
Route::get('explore/decks/{id}', [DeckController::class, 'show'])->name('expl.decks.show'); // both auth and guest


// flashcards
Route::resource('flashcards', FlashcardController::class)
    ->only(['index' ,'show', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('flashcards/create/{id}', [FlashcardController::class, 'create'])->name('flashcards.create')->middleware(['auth']);
Route::get('explore/flashcards/{id}', [FlashcardController::class, 'show'])->name('expl.flashcards.show'); // both auth and guest


//admin
Route::redirect('admin', 'login', 301);

Route::resource('admin/users', UserController::class)
    ->only(['index', 'edit', 'update', 'destroy'])
    ->middleware(['admin']);

Route::resource('admin/categories', CategoryController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['admin']);

Route::get('admin/topics', [TopicController::class, 'index'])->middleware(['admin'])->name('admin.topics.index');
Route::delete('admin/topics/{id}', [TopicController::class, 'destroy'])->middleware(['admin'])->name('admin.topics.destroy');
Route::get('admin/topics/{id}', [TopicController::class, 'indexUser'])->middleware(['admin'])->name('admin.topics.indexUser');

Route::delete('admin/decks/{id}', [DeckController::class, 'destroy'])->middleware(['admin'])->name('admin.decks.destroy');

Route::get('/banned', function () { return 'You are banned!'; } )->name('user.banned');

//
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
