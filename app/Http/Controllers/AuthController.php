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

    // Menangani proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // cek apakah yang login adalah admin
        if ($credentials['email'] === 'admin@example.com') {
            $credentials['role'] = 'admin';
        }
        // Jika role admin, maka login sebagai admin
        if ($credentials['role'] === 'admin') {
            $credentials['role'] = 'admin';
        } else {
            $credentials['role'] = 'user';
        }

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate(); // ✅ Tambahan penting
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
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
        ]);

        auth()->login($user);
        $request->session()->regenerate(); // ✅ Optional untuk keamanan ekstra

        return redirect()->route('dashboard');
    }

    // ✅ Menangani logout dengan aman
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();       // ✅ Hancurkan session lama
        $request->session()->regenerateToken();  // ✅ Buat token CSRF baru

        return redirect()->route('login');
    }
}
