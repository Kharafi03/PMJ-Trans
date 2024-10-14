<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DetailPaymentController extends Controller
{
    //
    public function show($bookingId)
    {
        $userId = Auth::id();
        // Ambil booking beserta relasi incomes
        // Ambil booking dengan relasi incomes dan cocokkan user_id
        $booking = Booking::with('incomes')
            ->where('id', $bookingId)
            ->where('id_cus', $userId) // Cocokkan userId dengan yang ada di booking
            ->first();

        // Jika booking tidak ditemukan atau userId tidak cocok, redirect back
        if (!$booking || $booking->incomes->isEmpty()) {
            return redirect()->back()->with([
                'message' => 'Pembayaran tidak ditemukan.',
                'alert-type' => 'error'
            ]);
        }

        // Return ke view dengan data booking dan incomes-nya
        return view('frontend.payment-history.index', compact('booking'));
    }
}
