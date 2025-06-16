<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        // Attempt to log the user in
        if (auth()->attempt($credentials)) {
            $user = Auth::user();
            
            // Cek jika user dibanned
            if ($user->is_banned) {
                auth()->logout();
                return back()->withErrors(['email' => 'Your account has been suspended.']);
            }

            // Regenerate session
            $request->session()->regenerate();

            // Handle intended URL
            if ($request->session()->has('url.intended')) {
                return redirect()->intended();
            }

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, Admin!');
            } else {
                return redirect()->route('dashboard')
                    ->with('success', 'Welcome to your dashboard!');
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email or password is incorrect.',
        ])->onlyInput('email');
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

        // Auto-set role admin untuk email tertentu (opsional)
        $role = $validated['email'] === 'admin@example.com' ? 'admin' : 'user';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $role,
            'is_banned' => false, // Default false
        ]);

        // Login user setelah register
        auth()->login($user);
        $request->session()->regenerate();

        // Redirect dengan pesan sukses
        return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'dashboard')
            ->with('success', 'Registration successful! Welcome '.$user->name);
    }

    // Menangani logout
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }

    // Method untuk redirect setelah login/register (jika menggunakan middleware)
    public function redirectTo()
    {
        if (auth()->user()->role === 'admin') {
            return route('admin.dashboard');
        }
        return route('dashboard');
    }
}