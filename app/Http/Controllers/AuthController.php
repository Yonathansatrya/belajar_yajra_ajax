<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return response()->json(['message' => 'Welcome Admin!', 'user' => $user], 200);
            }

            if ($user->role === 'user') {
                return response()->json(['message' => 'Welcome User!', 'user' => $user], 200);
            }
        }

        return response()->json(['message' => 'Invalid Email or Password'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Berhasil logout']);
    }

    public function dashboard()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin'){
            return redirect('https://www.youtube.com');
        }
        return view('dashboard');
    }
}
