<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
 
    public function register(Request $request)
{
    if ($request->isMethod('POST')) {
        $validatedData = $request->validate([]);
        $validatedData['name'] = $request->input('name');
        $validatedData['email'] = $request->input('email');
        $validatedData['password'] = Hash::make($request->input('password'));
        $validatedData['remember_token'] = Hash::make($request->input('email'));
        $validatedData['role'] = 'user';
        if(User::create($validatedData)){
            return redirect()->route('login')->with('success', 'Registration successful!');
        } else {
            return redirect()->back()->with('error', 'Registration failed!');
        }
    } else {
        return view('auth.register');
    }
}


    
   
    public function login(Request $request)
{
    if ($request->isMethod('POST')) {
        $validatedData = $request->validate([]);
        $validatedData['email'] = $request->input('email');
        $validatedData['password'] = $request->input('password');

        if (User::where($validatedData)->exists()) {
            session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }else{
        return view('auth.login');
    }
}
    
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
