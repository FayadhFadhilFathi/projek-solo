<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Mengarah ke resources\views\auth\login.blade.php
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi dan autentikasi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register'); // Mengarah ke resources\views\auth\register.blade.php
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
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }

    // Menangani logout
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
    