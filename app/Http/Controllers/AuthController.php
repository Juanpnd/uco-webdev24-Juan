<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial pengguna
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil, arahkan ke halaman utama
            return redirect()->route('home.index')->with('success', 'Login berhasil.');
        }

        // Login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Menangani proses logout pengguna.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }

    /**
     * Menampilkan form registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi pengguna baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input pengguna
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simpan data pengguna ke dalam database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Alihkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
?>