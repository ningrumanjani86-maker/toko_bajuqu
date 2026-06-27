<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //menampilkan halaman login
    public function showLogin(){
        return view('login');
    }
    //memproses data login
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return back()->withErrors([
            'login_error' => 'Email atau password salah.'
        ]);
    }

    // login berhasil
    $request->session()->regenerate();
    return redirect()->route('products.index'); // pastikan nama route sesuai
}

    //proses logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }
}
