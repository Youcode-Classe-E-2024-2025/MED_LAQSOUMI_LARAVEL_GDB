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
        $email = $request->input('email');
        $password = $request->input('password');
        if (user::where('email', $email)->exists() && Hash::check($password, User::where('email', $email)->first()->password)) {
            $request->session()->put('email', $email);
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid login details!');
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
