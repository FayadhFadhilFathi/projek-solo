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

        // Cek apakah pengguna berhasil login
        if (auth()->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user(); // Dapatkan data pengguna yang login

            // Periksa apakah pengguna adalah admin
            if ($user->role === 'admin') {
                $request->session()->regenerate(); // Regenerasi session
                return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
            }

            $request->session()->regenerate(); // Regenerasi session
            return redirect()->route('home'); // Redirect ke halaman utama
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
