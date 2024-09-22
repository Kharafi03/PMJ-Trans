<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.auth.login'); // Sesuaikan dengan path view form login Anda
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'number_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek kredensial pengguna
        $credentials = [
            'number_phone' => $request->number_phone,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            // Jika login berhasil, arahkan ke halaman yang sesuai
            return redirect()->intended(route('homepage'))
                ->with('message', 'Login Berhasil!')
                ->with('alert-type', 'success');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'number_phone' => 'Nomor telepon atau password salah.',
        ])->onlyInput('number_phone');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus session yang ada
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('homepage')
            ->with('message', 'Anda telah keluar.')
            ->with('alert-type', 'success');
    }
}
