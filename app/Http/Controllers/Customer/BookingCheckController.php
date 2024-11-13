<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Crypt;

class BookingCheckController extends Controller
{
    //
    public function index()
    {
        return view('frontend.booking-check.index'); // Sesuaikan nama view dengan yang Anda gunakan
    }

    /**
     * Mengecek status pemesanan berdasarkan kode booking dan nomor telepon.
     */
    public function status(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'booking_code' => 'required|string|max:255',
            'number_phone' => 'required|string|max:20',
        ]);

        // Cari data pemesanan berdasarkan kode booking dan nomor telepon
        $booking = Booking::where('booking_code', $request->booking_code)
            ->whereHas('customer', function ($query) use ($request) {
                $query->where('number_phone', $request->number_phone);
            })
            ->first();

        // Jika pemesanan ditemukan
        if ($booking) {
            $encryptedId = Crypt::encryptString($booking->id);
            
            return redirect()->route('booking.status', [ 
                'encryptedId' => $encryptedId
            ]);
        }

        // Jika tidak ditemukan, kembali dengan pesan error
        return back()
            ->with('message', 'Kode booking atau nomor telepon tidak ditemukan.')
            ->with('alert-type', 'error');
    }
}
