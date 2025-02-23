<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\User;

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
        
        return redirect()->back()->with('success', 'Book borrowed successfully.');
    }
}
