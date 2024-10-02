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
            'passwordBaru' => 'required|min:8',
            'konfirmasiPassword' => 'required|same:passwordBaru'
        ]);

        

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
