<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index()
    {
        return view('frontend.driver.profile-driver.index');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'passwordBaru' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[!@#$%^&*(),.?":{}|<>]/' // At least one special character
            ],
            'konfirmasiPassword' => 'required|same:passwordBaru'
        ], [
            'passwordBaru.required' => 'Password baru harus diisi!',
            'passwordBaru.min' => 'Password baru minimal harus 8 karakter!',
            'passwordBaru.confirmed' => 'Konfirmasi password harus sama dengan password baru!',
            'passwordBaru.regex' => 'Password harus mengandung setidaknya satu huruf kecil, satu huruf besar, satu angka, dan satu simbol!',
            'konfirmasiPassword.required' => 'Konfirmasi password harus diisi!',
            'konfirmasiPassword.same' => 'Konfirmasi password harus sama dengan password baru!'
        ]);
        
        /** @var \App\Models\User $user **/

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update password
        $user->password = Hash::make($request->passwordBaru);
        $user->save();

        return redirect()->back()->with([
            'message' => 'Password Berhasil Diperbarui!',
            'alert-type' => 'success'
        ]);
    }
}
