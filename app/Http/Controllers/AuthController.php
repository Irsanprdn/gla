<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        
        // Mengambil data login yang dimasukkan pengguna
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        // Jika login gagal, kirim pesan error ke view
        return back()->with('login_error', 'Email atau password salah.');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login');
    }
}
