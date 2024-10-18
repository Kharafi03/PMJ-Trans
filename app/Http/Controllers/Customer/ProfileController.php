<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan form profil
    public function edit()
    {
        $user = Auth::user(); // Mengambil data user yang sedang login
        return view('frontend.customer-profile.index', compact('user'));
    }

    // Memperbarui data profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:users,email,' . $user->id, // Email harus unik, kecuali untuk pengguna saat ini
            ],
            'number_phone' => [
                'required',
                'string',
                'max:20',
                'unique:users,number_phone,' . $user->id, // Number phone harus unik, kecuali untuk pengguna saat ini
            ],
            'address' => 'required|string',
        ], [
            'name.required' => 'Nama harus diisi!',
            'email.email' => 'Email tidak valid!',
            'number_phone.required' => 'Nomor telepon harus diisi!',
            'address.required' => 'Alamat harus diisi!',
            'number_phone.max' => 'Nomor telepon maksimal 20 karakter!',
            'email.max' => 'Email maksimal 255 karakter!',
            'number_phone.unique' => 'Nomor telepon sudah terdaftar!',
            'email.unique' => 'Email sudah terdaftar!',
            'email.email' => 'Email tidak valid!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
            ->withInput()
            ->with([
                'message' => 'Profil Gagal Diperbarui!',
                'alert-type' => 'error'
            ]);
        }

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Perbarui data pengguna
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'), // Email opsional
            'number_phone' => $request->input('number_phone'),
            'address' => $request->input('address'),
        ]);

        // Redirect setelah berhasil diperbarui
        return redirect()->route('profile.edit')
            ->with([
                'message' => 'Profil Berhasil Diperbarui!',
                'alert-type' => 'success'
            ]); 
    }

    public function updatePassword(Request $request)
    {
        // Validasi input dengan pesan kustom
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => 'required|min:8',
            'konfirmasi_password' => 'required|same:password_baru',
        ], [
            'password_lama.required' => 'Password lama harus diisi!',
            'password_baru.required' => 'Password baru harus diisi!',
            'password_baru.min' => 'Password baru minimal harus memiliki 8 karakter!',
            'konfirmasi_password.required' => 'Konfirmasi password harus diisi!',
            'konfirmasi_password.same' => 'Konfirmasi password harus sama dengan password baru!',
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Verifikasi apakah password lama cocok
        if (!Hash::check($request->input('password_lama'), $user->password)) {
            return redirect()->back()->withErrors([
                'password_lama' => 'Password lama tidak sesuai!'
            ])->withInput()
                ->with([
                    'message' => 'Password Gagal Diperbarui!',
                    'alert-type' => 'error'
                ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()
                ->with([
                    'message' => 'Password Gagal Diperbarui!',
                    'alert-type' => 'error'
                ]);
        }



        // Perbarui password pengguna
        $user->update([
            'password' => bcrypt($request->input('password_baru')),
        ]);

        // Redirect setelah berhasil diperbarui
        return redirect()->route('profile.edit')
            ->with([
                'message' => 'Password Berhasil Diperbarui!',
                'alert-type' => 'success'
            ]);
    }
}
