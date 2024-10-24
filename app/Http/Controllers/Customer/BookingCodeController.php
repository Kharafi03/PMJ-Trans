<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingCodeController extends Controller
{
    //
    public function show($booking_code)
    {
        // Ambil data booking berdasarkan booking_code
        $booking = Booking::where('booking_code', $booking_code)->first();
        $destinations = Destination::where('id_booking', $booking->id)->get();

        if ($booking->id_cus !== Auth::id()) {
            return redirect()->back()->with([
                'message' => 'Booking tidak ditemukan!',
                'alert-type' => 'error'
            ]);
        }

        if (!$booking) {
            return redirect()->route('home')->with('error', 'Booking tidak ditemukan.'); // Redirect jika tidak ada booking
        }

        // Cek apakah booking ditemukan dan customer memiliki email dan ticket_sent = false
        if ($booking && !$booking->ticket_sent && $booking->customer->email != null) {
            // Kirim email e-ticket kepada customer
            $setting = Setting::all();
            Mail::send('vendor.mail.ticket-email', compact('booking', 'destinations', 'setting'), function ($message) use ($booking) {
                $message->to($booking->customer->email, $booking->customer->name)
                    ->subject('E-Ticket PMJ Trans - ' . $booking->booking_code);
            });

            // Update kolom ticket_sent menjadi true
            $booking->ticket_sent = true;
            $booking->save();
        }

        return view('frontend.booking-code.index', compact('booking', 'destinations'));
    }
}
