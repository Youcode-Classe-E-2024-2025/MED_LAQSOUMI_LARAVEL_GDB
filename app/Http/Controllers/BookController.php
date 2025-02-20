<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::findAll();
        return view('book.index', ['books' => $books]);
    }

    public function show($id)
    {
        $book = Book::findById($id);
        return view('book.show', ['book' => $book]);
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'cover' => 'required',
            'isbn' => 'required',
        ]);
        if (Book::createBook($data)) {
            return redirect()->route('book.index')->with('success', 'Book created successfully!');
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

    public function destroy($id)
    {
        if (Book::deleteBook($id)) {
            return redirect()->route('book.index')->with('success', 'Book deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Book deletion failed!');
        }
    }
}
