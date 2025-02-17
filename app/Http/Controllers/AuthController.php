<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    
    public function register(Request $request)
    {
        $request->validate([]);
        // Create a new user
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'remember_token' => 'required',
        ]);
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'remember_token' => $validatedData['remember_token'],
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->validate([]); 
    }

    
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
