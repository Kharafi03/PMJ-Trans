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
        $bookings = Booking::where('id_cus', $userId)->get(); // Ambil booking berdasarkan id_cus

        // Mengirimkan data booking ke view
        return view('frontend.booking-history.index', compact('bookings'));
    }
}
