<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //

    public function index()
    {
        $countBus = Bus::count();
        
        return view('frontend.about.index', compact('countBus'));
    }
}
