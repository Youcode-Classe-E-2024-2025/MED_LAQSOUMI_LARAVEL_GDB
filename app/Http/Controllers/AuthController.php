<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
 
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
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
        $books = Book::all(); // Fetch all books
        $user = User::where('email', session()->get('email'))->first();

        if ($sessionRole == 'admin') {
            return view('dashboard.admin.admin', [
                'email' => session()->get('email'),
                'role' => $sessionRole,
                'name' => $user->name,
                'user' => $user,
                'users' => User::all(), // Fetch all users
                'books' => $books, // Pass books to the view
                'borrows' => Borrow::getAllBorrowings() // Fetch all borrows
            ]);
        } else {
            return view('dashboard.user', [
                'email' => session()->get('email'),
                'role' => $sessionRole,
                'name' => $user->name,
                'user' => $user,
                'created_at' => $user->created_at,
                'books' => $books // Pass books to the view
            ]);
        }
    } else {
        return redirect()->route('login')->with('error', 'Please login to access');
    }
    }

    public function profile ()
    {
        $user = User::where('email', session()->get('email'))->first();
        $email = session()->get('email');
        $role = session()->get('role');
        $name = $user->name;
        $created_at = $user->created_at;
        return view('auth.profile', [
            'user' => $user,
            'email' => $email,
            'role' => $role,
            'name' => $name,
            'created_at' => $created_at
        ]);
    }

    public function editProfile(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50|min:6',
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
            $user = User::where('email', session()->get('email'))->first();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            if ($user->save()) {
                session()->put('email', $user->email);
                return redirect()->route('profile')->with('success', 'Profile updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Profile update failed!');
            }
        } else {
            return view('auth.edit-profile', ['email' => session()->get('email'), 'name' => User::where('email', session()->get('email'))->first()->name]);
        }
    }


}