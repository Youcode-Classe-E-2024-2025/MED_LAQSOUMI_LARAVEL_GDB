<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class BookController extends Controller
{
    public function booksJson(Request $request)
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function books($id=null)
    {
        $books = Book::all();
        $user = User::find($id);
        return view('dashboard.admin.manageBooks', ['books' => $books, 'user'=>$user]);
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
        $book = Book::find($id); // Corrected method to find the book by ID
        return view('dashboard.admin.manageBooks', ['book' => $book]);
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
        $book = Book::find($id);
        $user = User::find($book->user_id);
        $users = User::all();
        return view('dashboard.booksDetaills', [
            'book' => $book,
            'user' => $user,
            'users' => $users
        ]);
    }


    public function bookSearch($query)
    {
        $books = Book::where('title', 'like', '%' . $query . '%')
            ->orWhere('author', 'like', '%' . $query . '%')
            ->orWhere('isbn', 'like', '%' . $query . '%')
            ->get();
        return response()->json($books);
    }

    public function updateBook(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'cover' => 'required|url',
            'isbn' => 'required|min:13|max:13',
        ]);

        $book = Book::find($id);
        if ($book->update($validatedData)) {
            return redirect()->route('manageBooks')->with('success', 'Book updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Book update failed!');
        }
    }
}