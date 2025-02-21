<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class StatisticsController extends Controller
{
    public function recentActivity()
    {
        $books = Book::orderBy('created_at', 'desc')->limit(5)->get();
        $users = User::orderBy('created_at', 'desc')->limit(5)->get();
        return view('dashboard.admin.admin', ['books' => $books, 'users' => $users]);
    }
}