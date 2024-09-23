<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'number_phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
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
            ->with('message', 'Profil Berhasil Diperbarui!')
            ->with('alert-type', 'success');
    }
}
