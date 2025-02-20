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
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $email = $request->input('email');
            $password = $request->input('password');
            $user = User::where('email', $email)->first();
            if ($user && Hash::check($password, $user->password)) {
                $request->session()->put('email', $email);
                $request->session()->regenerate();
                $request->session()->put('role', $user->role);
                $request->session()->put('created_at', $user->created_at);
                return redirect()->route('dashboard')->with('success', 'Welcome back '. $user->name);
            } else {
                return redirect()->back()->with('error', 'Invalid login details!');
            }
        } else {
            return view('auth.login');
        }
    }
    
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        if (session()->has('email')) {
            $sessionRole = session()->get('role');
            if ($sessionRole == 'admin') {
                return view('dashboard.admin.admin', ['email' => session()->get('email'), 'role' => $sessionRole, 'name' => User::where('email', session()->get('email'))->first()->name]);
            } else {
                return view('dashboard.user', ['email' => session()->get('email'), 'role' => $sessionRole, 'name' => User::where('email', session()->get('email'))->first()->name]);
            }
        } else {
            return redirect()->route('login')->with('error', 'Please login to access');
        }
    }

    public function profile ()
    {
        if (session()->has('email')) {
            return view('auth.profile', ['email' => session()->get('email'), 'name' => User::where('email', session()->get('email'))->first()->name]);
        } else {
            return redirect()->route('login')->with('error', 'Please login to access');
        }
    }


}