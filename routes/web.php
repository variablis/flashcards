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

Route::get('topics/{id}', [TopicController::class, 'indexCategory'])->name('topics.indexCategory');
Route::get('topic/copy/{id}', [TopicController::class, 'copy'])->name('topic.copy')->middleware(['auth']);
Route::get('topic/test/{id}', [TopicController::class, 'test'])->name('topic.test');

// decks
Route::resource('decks', DeckController::class)
    ->only(['index', 'store', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

Route::get('decks/{id}', [DeckController::class, 'show'])->name('decks.show'); // both aauth and guest
Route::get('deck/create/{id}', [DeckController::class, 'create'])->name('deck.create');
Route::get('deck/copy/{id}/{tid}', [DeckController::class, 'copy'])->name('deck.copy')->middleware(['auth']);

// flashcards
Route::resource('flashcards', FlashcardController::class)
    ->only(['index' ,'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('flashcards/{id}', [FlashcardController::class, 'show'])->name('flashcards.show'); // both aauth and guest
Route::put('flashcard/{id}', [FlashcardController::class, 'update'])->name('flashcard.update');
Route::get('flashcard/create/{id}', [FlashcardController::class, 'create'])->name('flashcard.create');

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

Route::delete('admin/decks', [DecksController::class, 'destroy'])->middleware(['admin'])->name('admin.decks.destroy');

Route::get('/banned', function () { return 'You are banned!'; } )->name('user.banned');

//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
