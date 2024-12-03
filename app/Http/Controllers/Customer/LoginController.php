<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
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

        // Cek apakah nomor telepon terdaftar
        $user = User::where('number_phone', $request->number_phone)->first();

        if (!$user) {
            // Jika nomor telepon tidak terdaftar, tampilkan error pada field number_phone
            return back()->withErrors([
                'number_phone' => 'Nomor telepon tidak terdaftar!',
            ])->onlyInput('number_phone');
        }

        // Cek kredensial dengan nomor telepon dan password
        $credentials = [
            'number_phone' => $request->number_phone,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            // Jika login berhasil, cek role pengguna
            $role = $user->roles->first(); // Ambil role pertama dari koleksi roles

            if (($role && $role->name === 'Driver') || ($role && $role->name === 'Kru')) {
                return redirect('/driver/dashboard')
                    ->with('message', 'Login Berhasil! Anda di arahkan ke dashboard driver.')
                    ->with('alert-type', 'success');
            }

            // Jika bukan role Driver, arahkan ke halaman utama
            return redirect()->intended(route('homepage'))
                ->with('message', 'Login Berhasil!')
                ->with('alert-type', 'success');
        }

        // Jika password salah, tampilkan error pada field password
        return back()->withErrors([
            'password' => 'Password salah.',
        ])->onlyInput('password');
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
