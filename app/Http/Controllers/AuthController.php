<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard'); // Ganti '/dashboard' dengan halaman yang diinginkan setelah login
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Menangani logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Menampilkan form register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/dashboard'); // Ganti '/dashboard' dengan halaman yang diinginkan setelah register
    }
}
?>