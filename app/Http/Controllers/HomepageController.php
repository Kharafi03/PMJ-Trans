<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    //
    public function index()
    {   
        
        return view('frontend.booking.homepage'); // Ganti dengan view yang Anda inginkan
    }
}
