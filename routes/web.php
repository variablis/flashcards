<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TopicController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\FlashcardController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('welc');

Route::get('/', [DeckController::class, 'explore'])->name('expl');
// Route::get('topic/{id}', [TopicController::class, 'show'])->name('topic.show');


Route::resource('topics', TopicController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);


Route::resource('decks', DeckController::class)
    ->only(['index','store', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);


Route::get('decks/{id}', [DeckController::class, 'show'])->name('decks.show'); // both aauth and guest

Route::get('decks/test/{id}', [DeckController::class, 'test'])->name('decks.test');
Route::get('deck/create/{id}', [DeckController::class, 'create'])->name('deck.create');


Route::resource('flashcards', FlashcardController::class)
    ->only(['index' ,'store', 'create'])
    ->middleware(['auth', 'verified']);

Route::get('flashcards/{id}', [FlashcardController::class, 'show'])->name('flashcards.show'); // both aauth and guest

Route::put('flashcard/{id}', [FlashcardController::class, 'update'])->name('flashcard.update');
Route::get('flashcard/create/{id}', [FlashcardController::class, 'create'])->name('flashcard.create');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
