<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;






// SYSTEM AUTHENTICATION
Route::get('/', function () {return view('/welcome');})->name('welcome');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
// Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('edit-profile');
// Route::post('/edit-profile', [AuthController::class, 'editProfile']);
// Route::get('/change-password', [AuthController::class, 'changePassword'])->name('change-password');