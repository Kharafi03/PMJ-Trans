<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function index()
    {
        // Anda bisa mengirim data ke view, atau melakukan proses lain di sini
        return view('frontend.booking.homepage'); // Ganti dengan view yang Anda inginkan
    }
}
