<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Destination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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

        return view('frontend.booking-code.index', compact('booking', 'destinations'));
    }

    // Tambahkan metode untuk generate PDF
    public function downloadPdf($booking_code)
    {
        // Ambil data booking dan destinasi
        $booking = Booking::where('booking_code', $booking_code)->first();
        $destinations = Destination::where('id_booking', $booking->id)->get();

        if (!$booking) {
            return redirect()->route('home')->with('error', 'Booking tidak ditemukan.');
        }

        // Generate PDF dari view 'pdf.booking-code'
        $pdf = Pdf::loadView('frontend.booking-code.pdf', compact('booking', 'destinations'))
            ->setPaper('a4', 'portrait');
        
        // Unduh file PDF dengan nama sesuai booking code
        return $pdf->stream('Booking-'.$booking_code.'.pdf');
    }
}
