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
        
       
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->get();
        
        
        // Anda bisa mengirim data ke view, atau melakukan proses lain di sini
        return view('frontend.booking.homepage'); // Ganti dengan view yang Anda inginkan
    }
}
