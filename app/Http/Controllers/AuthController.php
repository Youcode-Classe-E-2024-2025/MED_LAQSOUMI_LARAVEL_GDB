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
    if ($request->isMethod('POST')) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Ensure you have a confirmation field in your form
        ]);

        var_dump($validatedData);
        // Hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user
        User::create($validatedData);

        return redirect()->route('login')->with('success', 'Registration successful!');
    } else {
        return view('auth.register');
    }
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
