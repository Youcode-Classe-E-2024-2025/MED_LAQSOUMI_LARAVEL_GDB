<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StatisticsController;

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
Route::get('/books', [BookController::class, 'books'])->name('books');
Route::get('/books/create', [BookController::class, 'create'])->name('create-book');
Route::post('/books/create', [BookController::class, 'createBook']);
Route::get('/books/edit/{id}', [BookController::class, 'editBook'])->name('edit-book');
Route::post('/books/edit/{id}', [BookController::class, 'editBook']);
Route::get('/books/delete/{id}', [BookController::class, 'deleteBook'])->name('delete-book');
Route::post('/books/delete/{id}', [BookController::class, 'deleteBook']);

// STATISTICS