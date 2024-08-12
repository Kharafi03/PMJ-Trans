<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Logic untuk menampilkan profil pengguna
        return view('profile.index');
    }
}
