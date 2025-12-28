<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function saveAuthor(Request $request)
    {
        $attributes  = request()->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|min:1|max:255|email:rfc,dns',
        ]);

        // statt button nach dem speichern direkt zur liste
        // return redirect(route('/list'))

        $authors = Author::create($attributes);

        return back()->with('success', 'Your Author has been added successfully');
    }

    public function destroyAuthor(Author $author)
    {
        $author->delete();

        return back()->with('success', 'Author deleted successfully');
    }

    public function editAuthor(Author $author)
    {
        return view('authors.edit',[
            'author' => $author
        ]);
    }
    public function updateAuthor(Author $author){
        $attributes  = request()->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|min:1|max:255|email:rfc,dns',
        ]);

        $author->update($attributes);
        return back()->with('success', 'Author saved');
    }

    public function listAuthors(): View
    {
        $authors = Author::all();

        return view('authors.list', [
            'authors' => $authors,
        ]);
    }
}
