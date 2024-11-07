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
        $showAlertPassword = Hash::check('12345678', $user->password);

        return view('frontend.customer-profile.index', compact('user', 'showAlertPassword'));
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
            'email.max' => 'Email maksimal 255 karakter!',
            'email.unique' => 'Email sudah terdaftar!',
            'number_phone.required' => 'Nomor telepon harus diisi!',
            'number_phone.unique' => 'Nomor telepon sudah terdaftar!',
            'number_phone.max' => 'Nomor telepon maksimal 20 karakter!',
            'address.required' => 'Alamat harus diisi!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
            ->withInput()
            ->with([
                'message' => 'Profil Gagal Diperbarui!',
                'alert-type' => 'error'
            ]);
        }

        /** @var \App\Models\User $user **/

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
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => [
                'required',
                'min:8',
                'regex:/[a-z]/',        // At least one lowercase letter
                'regex:/[A-Z]/',        // At least one uppercase letter
                'regex:/[0-9]/',        // At least one digit
                'regex:/[!@#$%^&*(),.?":{}|<>]/' // At least one special character
            ],
            'konfirmasi_password' => 'required|same:password_baru',
        ], [
            'password_lama.required' => 'Password lama harus diisi!',
            'password_baru.required' => 'Password baru harus diisi!',
            'password_baru.min' => 'Password baru minimal harus memiliki 8 karakter!',
            'password_baru.regex' => 'Password baru harus mengandung setidaknya satu huruf kecil, satu huruf besar, satu angka, dan satu simbol!',
            'konfirmasi_password.required' => 'Konfirmasi password harus diisi!',
            'konfirmasi_password.same' => 'Konfirmasi password harus sama dengan password baru!',
        ]);        

        /** @var \App\Models\User $user **/

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
