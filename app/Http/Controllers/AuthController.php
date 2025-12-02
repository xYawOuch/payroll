<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        // If already logged in → go to dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('auth.login');
    }

    // Process login
    public function login(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'password' => 'required|string'
        ]);

        // find user by the id field (adjust column name if necessary)
        $user = User::where('id', $request->input('id'))->first();

        if (!$user) {
            return back()->withErrors([
                'id' => 'User ID is incorrect.',
            ]);
        }

        // check password against the stored hash
        if (!Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors([
                'password' => 'Password is incorrect.',
            ]);
        }

        // credentials OK — log the user in
        Auth::login($user);

        return redirect('/dashboard');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.register');
    }

    // Process registration
    public function register(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|unique:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = new User();
        // if your users table uses auto-increment id, remove the next line and adjust validation
        $user->id = $request->input('id');

        $user->name = $request->input('name');
        // set a default email if you don't collect one or keep null
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);

        return redirect('/dashboard');
    }
}
