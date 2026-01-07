<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
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

Route::get('/booklist', [BookController::class, 'listBooks'])->middleware(['auth'])->name('books.list');
Route::post('/booklist', [BookController::class, 'saveBook'])->middleware(['auth'])->name('books.save');
Route::delete('/booklist/{book}', [BookController::class, 'destroy'])->middleware(['auth'])->name('books.destroy');
Route::get('booklist/{book}/edit', [BookController::class, 'edit'])->middleware(['auth'])->name('books.edit');
Route::patch('booklist/{book}', [BookController::class, 'update'])->middleware(['auth'])->name('books.update');

Route::get('/authorlist', [AuthorController::class, 'listAuthors'])->middleware(['auth'])->name('authors.list');
Route::post('/authorlist', [AuthorController::class, 'saveAuthor'])->middleware(['auth'])->name('authors.save');
Route::delete('/authorlist/{author}', [AuthorController::class, 'destroyAuthor'])->middleware(['auth'])->name('authors.destroy');
Route::get('/authorlist/{author}/edit', [AuthorController::class, 'editAuthor'])->middleware(['auth'])->name('authors.edit');
Route::patch('authorlist/{author}', [AuthorController::class, 'updateAuthor'])->middleware(['auth'])->name('authors.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
