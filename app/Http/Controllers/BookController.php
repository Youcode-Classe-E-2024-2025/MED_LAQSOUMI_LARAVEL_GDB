<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

    
    public function books(Request $request)
{
    $query = $request->input('query');
    if ($query) {
        $books = Book::where('title', 'like', '%' . $query . '%')
            ->orWhere('author', 'like', '%' . $query . '%')
            ->orWhere('isbn', 'like', '%' . $query . '%')
            ->get();
    } else {
        $books = Book::all();
    }

    return view('dashboard.booksDisplay', ['books' => $books]);
}

    public function create()
    {
        return view('dashboard.admin.createBooks');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:books|max:50|min:3',
            'author' => 'required|max:50|min:5',
            'description' => 'required|max:255|min:10',
            'price' => 'required|numeric',
            'cover' => 'required|string',
            'isbn' => 'required|unique:books|max:13|min:13',
            'category' => 'required',
            'status' => 'required',
        ]);
        if (Book::createBook($data)) {
            return redirect()->route('dashboard.admin.manageBooks')->with('success', 'Book created successfully!');
        } else {
            return redirect()->back()->with('error', 'Book creation failed!');
        }
    }

    public function edit($id)
    {
        $book = Book::findById($id);
        return view('book.edit', ['book' => $book]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'cover' => 'required',
            'isbn' => 'required',
        ]);
        if (Book::updateBook($id, $data)) {
            return redirect()->route('book.index')->with('success', 'Book updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Book update failed!');
        }
    }

    public function delete($id)
    {
        if (Book::deleteBook($id)) {
            return redirect()->route('dashboard.user')->with('success', 'Book deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Book deletion failed!');
        }
    }

    public function show($id)
    {
        $book = Book::findById($id);
        return view('dashboard.booksDetaills', ['book' => $book]);
    }
}
