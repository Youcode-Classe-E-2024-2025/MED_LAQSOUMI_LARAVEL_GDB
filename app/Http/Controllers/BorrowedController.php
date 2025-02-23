<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Borrow;

class BorrowedController extends Controller
{
    public function borrowed()
    {
        $borrowedBooks = Borrow::with('book', 'user')->borrowed()->get();
        return view('dashboard.admin.borrowed', compact('borrowedBooks'));
    }

    public function borrowedJson()
    {
        $borrowedBooks = Borrow::with('book', 'user')->borrowed()->get();
        return response()->json($borrowedBooks);
    }
    
    public function createBorrowed(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id'
        ]);
        
        Borrow::create([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'borrowed_at' => now(),
            'returned_at' => null
        ]);
        
        return redirect()->route('myBooks', ['user_id' => $request->user_id])->with('success', 'Book borrowed successfully.');
    }

    public function myBooks($user_id)
    {
        $user = User::findOrFail($user_id);
        $borrowedBooksByUser = Borrow::getBorrowingByUserId($user_id);
            
        return view('dashboard.myBooks', [
            'borrowedBooksByUser' => $borrowedBooksByUser,
            'user' => $user
        ]);
    }
}
