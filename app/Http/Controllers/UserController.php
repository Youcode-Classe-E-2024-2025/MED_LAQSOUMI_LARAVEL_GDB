<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('dashboard.admin.manageUsers', ['users' => $users]);
    }

    private function checkAdminLimit()
    {
        $adminCount = User::where('role', 'admin')->count();
        return $adminCount >= 3;
    }

    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user'
        ]);

        if ($validatedData['role'] === 'admin' && $this->checkAdminLimit()) {
            return redirect()->back()->with('error', 'Maximum number of admins (3) has been reached!');
        }

        $validatedData['password'] = bcrypt($validatedData['password']);
        
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->role = $validatedData['role'];
        
        if ($user->save()) {
            return redirect()->route('manageUsers')->with('success', 'User created successfully!');
        } else {
            return redirect()->back()->with('error', 'User creation failed!');
        }
    }

    public function updateUser(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:admin,user'
        ]);

        $user = User::find($id);
        
        // Check admin limit only if user is being changed to admin
        if ($validatedData['role'] === 'admin' && $user->role !== 'admin' && $this->checkAdminLimit()) {
            return redirect()->back()->with('error', 'Maximum number of admins (3) has been reached!');
        }

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($user->save()) {
            return redirect()->route('manageUsers')->with('success', 'User updated successfully!');
        } else {
            return redirect()->back()->with('error', 'User update failed!');
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return redirect()->route('manageUsers')->with('success', 'User deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'User deletion failed!');
        }
    }
}