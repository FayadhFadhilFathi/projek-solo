<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
{
    return view('auth.login');
}

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Attempt to log the user in
        if (auth()->attempt($credentials)) {
            $user = Auth::user(); // Get the logged-in user's data
            // Regenerate the session to prevent session fixation
            $request->session()->regenerate();
            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
            } else {
                return redirect()->route('dashboard'); // Redirect to user dashboard
            }
        }
        // If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'Email or password is incorrect.',
        ]);
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Menangani proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'user', // Set default role
        ]);

        auth()->login($user);
        $request->session()->regenerate(); // Regenerasi session

        return redirect()->route('dashboard');
    }

    // Menangani logout dengan aman
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();       // Hancurkan session lama
        $request->session()->regenerateToken();  // Buat token CSRF baru

        return redirect()->route('login');
    }
}
