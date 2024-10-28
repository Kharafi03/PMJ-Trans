<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\TermsAndConditions;
use App\Models\Bus;
use App\Models\Review;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //

    public function index()
    {
        $faqs = Faq::all();
        $tacs = TermsAndConditions::all();
        $reviews = Review::inRandomOrder()->take(3)->get();
        $buses = Bus::whereHas('ms_buses', function ($query) {
            $query->where('id', 1); // 'id' sesuai dengan kolom primary key di tabel ms_buses
        })
        ->with('images')
        ->get();

        return view('frontend.homepage', compact('faqs', 'tacs', 'buses', 'reviews'));
    }
}
