<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
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
                ->with([
                    'incomes' => function ($query) {
                        $query->whereIn('id_m_income', [1, 2]); // DP dan Pelunasan
                    }
                ])
                ->get();

        $destination = $bookings->map(function ($booking) {
            return $booking->destination;
        });
        
        // dd($bookings);

        return view('frontend.booking-history.index', compact('bookings', 'destination'));
    }
}
