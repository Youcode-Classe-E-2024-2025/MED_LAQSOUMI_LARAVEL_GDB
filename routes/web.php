<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowedController;

// AUTHENTICATION
Route::get('/', function () {return view('/welcome');})->name('welcome');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::post('/profile/edit', [AuthController::class, 'editProfile'])->name('editProfile');

// BOOKS
Route::get('/manageBooks', [BookController::class, 'books'])->name('manageBooks');
Route::get('/booksJson', [BookController::class, 'booksJson'])->name('booksJson');
Route::get('/book/search/{query}', [BookController::class, 'bookSearch'])->name('book-search');
Route::get('/books/view/{id}', [BookController::class, 'show'])->name('view-book');
Route::post('/books/create', [BookController::class, 'createBook'])->name('create-book');
Route::match(['post', 'put'], '/books/update/{id}', [BookController::class, 'updateBook'])->name('update-book');
Route::get('/books/delete/{id}', [BookController::class, 'deleteBook'])->name('delete-book');

// BORROWED