<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingCodeController extends Controller
{
    //
    public function show($booking_code)
    {
        // Ambil data booking berdasarkan booking_code
        $booking = Booking::where('booking_code', $booking_code)->first();

        if (!$booking) {
            return redirect()->route('home')->with('error', 'Booking tidak ditemukan.'); // Redirect jika tidak ada booking
        }

        return view('frontend.booking-code.index', compact('booking'));
    }
}
