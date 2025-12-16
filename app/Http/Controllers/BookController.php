<?php

namespace App\Http\Controllers;

use App\Models\Book;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\View\View;

class   BookController extends Controller
{
    public function saveBook(Request $request)
    {
        $attributes  = request()->validate([
            'isbn' => 'required|min:3|max:255',
            'title' => 'required|min:1|max:255',
            'pages' => 'required|integer',
        ]);

        // dd('aus');

        $book = Book::create($attributes);

        return back()->with('success', 'Your Book has been added successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('success', 'Book deleted successfully');
    }



    public function listBooks(): View
    {
        // Abfrage mit model class Book
        $books = Book::all();

        /*
        $username = auth()->user()->name;

        $numbers = [];

        for($i = 0; $i < 10; $i++){
            $numbers[] = rand(1, 10);
        }
        */
        return view('list', [
            'books' => $books,
            // 'username' => $username,
            // 'nums' => $numbers
        ]);
    }
}
