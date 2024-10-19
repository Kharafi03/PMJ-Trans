<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;


class HistoryController extends Controller
{
    // Menampilkan halaman riwayat pemesanan user yang sedang login
    public function index()
    {
        // Mengambil data booking berdasarkan id user yang sedang login
        $userId = Auth::id(); // Mendapatkan ID user yang sedang login
        // $bookings = Booking::where('id_cus', $userId)->get(); // Ambil booking berdasarkan id_cus
        // $bookings = Booking::where('id_cus', $userId)->with('incomes')->get();

        // Ambil booking dengan DP (id_m_income = 1) dan Pelunasan (id_m_income = 2)
        $bookings = Booking::where('id_cus', $userId)
            ->with('incomes', 'review') // Mengambil semua incomes tanpa filter
            ->get();

        $destination = $bookings->map(function ($booking) {
            return $booking->destination;
        });

        // dd($bookings);

        return view('frontend.booking-history.index', compact('bookings', 'destination'));
    }

    // Fungsi untuk menyimpan rating dan feedback
    public function storeReview(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_booking' => 'required|exists:bookings,id',
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Simpan ke tabel reviews
        Review::create([
            'id_booking' => $request->input('id_booking'),
            'feedback' => $request->input('feedback'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->back()->with([
            'message' => 'Terima kasih atas ulasan Anda!',
            'alert-type' => 'success'
        ]);
    }

    public function show($booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)->first();

        if (!$booking) {
            return redirect()->route('home')->with([
                'message' => 'Booking tidak ditemukan!',
                'alert-type' => 'error'
            ]);
        }

        // Cek apakah booking ini milik pengguna yang sedang login
        if ($booking->id_cus !== Auth::id()) {
            return redirect()->back()->with([
                'message' => 'Booking tidak ditemukan!',
                'alert-type' => 'error'
            ]);
        }

        $feedbacks = Review::where('id_booking', $booking->id)->get();
        $destination = Destination::where('id_booking', $booking->id)->get();

        return view('frontend.booking-history.detail', compact('booking', 'destination', 'feedbacks'));
    }
}
