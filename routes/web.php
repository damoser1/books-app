<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokenController;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'usersCount' => User::count(),
        'booksCount' => Book::count(),
        'authorsCount' => Author::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

/*
Route::get('/list', function (){
    return view('list');
})->middleware(['auth'])->name('list');
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/booklist', [BookController::class, 'listBooks'])->name('books.list');
    Route::post('/booklist', [BookController::class, 'saveBook'])->name('books.save');
    Route::delete('/booklist/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('booklist/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('booklist/{book}', [BookController::class, 'update'])->name('books.update');

    Route::get('/authorlist', [AuthorController::class, 'listAuthors'])->name('authors.list');
    Route::post('/authorlist', [AuthorController::class, 'saveAuthor'])->name('authors.save');
    Route::delete('/authorlist/{author}', [AuthorController::class, 'destroyAuthor'])->name('authors.destroy');
    Route::get('/authorlist/{author}/edit', [AuthorController::class, 'editAuthor'])->name('authors.edit');
    Route::patch('authorlist/{author}', [AuthorController::class, 'updateAuthor'])->name('authors.update');

    Route::get('/tokenlist',[TokenController::class, 'listTokens'])->name('tokens.list');
    Route::post('/tokenlist',[TokenController::class, 'saveToken'])->name('tokens.save');
    Route::delete('/tokenlist/{token}', [TokenController::class, 'destroy'])->name('tokens.destroy');
});



require __DIR__.'/auth.php';
