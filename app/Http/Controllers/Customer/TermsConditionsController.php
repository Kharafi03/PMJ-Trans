<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{
    //

    public function index()
    {
        $terms = TermsAndConditions::all();

        return view('frontend.terms-conditions.index', compact('terms'));
    }
}
