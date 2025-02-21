<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function booksJson(Request $request)
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function books()
    {
        $books = Book::all();
        return view('dashboard.admin.manageBooks', ['books' => $books]);
    }

    public function createBook(Request $request) // Renamed from create to createBook
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'cover' => 'required|url',
            'isbn' => 'required|min:13|max:13',
        ]);
        if (Book::create($validatedData)) {
            return redirect()->route('manageBooks')->with('success', 'Book created successfully!');
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

    public function deleteBook($id)
    {
        if (Book::deleteBook($id)) {
            return redirect()->route('manageBooks')->with('success', 'Book deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Book deletion failed!');
        }
    }

    public function show($id)
    {
        $book = Book::findById($id);
        return view('dashboard.booksDetaills', ['book' => $book]);
    }

    public function bookSearch($query)
    {
        $books = Book::where('title', 'like', '%' . $query . '%')
            ->orWhere('author', 'like', '%' . $query . '%')
            ->orWhere('isbn', 'like', '%' . $query . '%')
            ->get();
        return response()->json($books);
    }
}