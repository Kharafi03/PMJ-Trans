<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverLoginController extends Controller
{
    /**
     * Menampilkan form login untuk Driver.
     * Jika sudah login, arahkan ke dashboard driver.
     */
    public function showLoginForm()
    {
        // Jika user sudah login
        if (Auth::check()) {
            // Cek jika user yang login memiliki role Driver
            if (Auth::user()->roles->first()->name === 'Driver') {
                // Jika sudah login sebagai Driver, redirect ke dashboard driver
                return redirect()->route('dashboard-driver');
            }

            // Jika user dengan role lain mencoba mengakses, arahkan ke halaman dashboard mereka
            return redirect()->route('homepage')->with([
                'message' => 'Anda tidak memiliki akses ke halaman login driver.',
                'alert-type' => 'error',
            ]);
        }

        // Jika belum login, tampilkan halaman login
        return view('frontend.driver.auth.login'); // Sesuaikan nama view dengan yang digunakan
    }

    /**
     * Menangani proses login Driver
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'number_phone' => 'required',
            'password' => 'required|min:8',
        ]);

        // Coba autentikasi user dengan role Driver
        if (Auth::attempt($credentials)) {
            // Pastikan user yang login memiliki role Driver
            if (Auth::user()->roles->first()->name === 'Driver') {
                // Redirect ke dashboard driver jika sukses
                return redirect()->route('dashboard-driver')
                    ->with([
                        'message' => 'Login Berhasil! Anda di arahkan ke dashboard driver.',
                        'alert-type' => 'success'
                    ]);
            } else {
                // Jika bukan Driver, logout dan redirect kembali ke login dengan pesan error
                Auth::logout();
                return redirect()->route('driver.login')->withErrors([
                    'number_phone' => 'Anda tidak memiliki akses sebagai Driver.',
                ]);
            }
        }

        // Jika gagal login, kembalikan ke halaman login dengan error
        return back()->withErrors([
            'number_phone' => 'Login gagal. Periksa kembali nomer whatsapp dan password Anda.',
        ]);
    }
}
