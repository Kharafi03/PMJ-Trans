<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    //
    public function index()
    {
        return view('frontend.driver.auth.reset'); // Sesuaikan nama view dengan yang Anda gunakan
    }

    public function sendWhatsApp(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'number_phone' => 'required|numeric',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ], [
            'number_phone.required' => 'Nomor WhatsApp harus diisi',
            'name.required' => 'Nama harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'number_phone.numeric' => 'Nomor WhatsApp harus berupa angka'
        ]);

        // Ambil data dari request
        $name = $validated['name'];
        $number_phone = $validated['number_phone'];
        $password = $validated['password'];
        
        // Nomor WhatsApp admin
        $adminPhoneNumber = '+6289619636519'; // Ganti dengan nomor admin, diawali dengan kode negara (tanpa tanda plus)

        // Format pesan
        $message = "Halo saya Driver {$name}, saya ingin mengubah password untuk akun dengan nomor handphone {$number_phone} dengan password baru yaitu {$password}";

        // Buat URL WhatsApp
        $whatsappURL = "https://wa.me/{$adminPhoneNumber}?text=" . urlencode($message);

        // Redirect ke URL WhatsApp
        return redirect()->away($whatsappURL);
    }
}
