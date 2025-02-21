<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowings;
use App\Models\User;

class BorrowedController extends Controller
{
    public function index()
    {
        $borrowedBooks = Borrowings::with('book', 'user')->borrowed()->get();
        return view('dashboard.admin.borrowed', compact('borrowedBooks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        Borrowings::create([
            'book_id' => $request->book_id,
            'user_id' => User::id(),
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14), // Set due date to 14 days from now
        ]);

        return redirect()->route('borrowed.index')->with('success', 'Book borrowed successfully.');
    }

    public function returnBook($id)
    {
        $borrowing = Borrowings::findOrFail($id);
        $borrowing->update(['returned_at' => now()]);

        return redirect()->route('borrowed.index')->with('success', 'Book returned successfully.');
    }

    public function borrowedBookByUser($id)
    {
        $borrowedBooks = Borrowings::where('user_id', $id)->get();
        return response()->json($borrowedBooks);
    }
}
