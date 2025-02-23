<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\User;

class BorrowedController extends Controller
{
    public function index()
    {
        $borrowedBooks = Borrow::with('book', 'user')->borrowed()->get();
        return view('dashboard.admin.borrowed', compact('borrowedBooks'));
    }

    public function createBorrowed(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
        
        Borrow::create([
            'book_id' => $request->book_id,
            'user_id' => User::id(),
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14), // Set due date to 14 days from now
        ]);
        
        return redirect()->route('borrowed.index')->with('success', 'Book borrowed successfully.');
    }

    public function show($id)
    {
        $borrowing = Borrow::with('book', 'user')->findOrFail($id);
        return response()->json($borrowing);
    }

    public function deleteBorrowed($id)
    {
        $borrowing = Borrow::findOrFail($id);
        $borrowing->delete();
        return redirect()->route('borrowed.index')->with('success', 'Book deleted successfully.');
    }

    public function borrowedBookByUser($id)
    {
        $borrowedBooks = Borrow::where('user_id', $id)->get();
        return response()->json($borrowedBooks);
    }
}
