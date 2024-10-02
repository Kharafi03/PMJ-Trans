<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TripBus;
use App\Models\TripBusSpend;
use App\Models\Booking;

class HistorySpendTripController extends Controller
{
    //
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil trip dengan kondisi yang diperlukan
        $trip = TripBus::where('id_ms_trip', 2) // Saring trip berdasarkan id_ms_trip
            ->where(function ($query) use ($userId) {
                // Cek apakah id_driver atau id_codriver adalah ID pengguna yang sedang login
                $query->where('id_driver', $userId)
                    ->orWhere('id_codriver', $userId);
            })
            ->first(); // Ambil trip pertama yang cocok

        // Cek apakah trip ditemukan
        if (!$trip) {
            // Jika tidak ditemukan, kembalikan ke halaman utama
            return redirect()->route('dashboard-driver')->with([
                'message' => 'Trip tidak ditemukan.',
                'alert-type' => 'error'
            ]);
        }

        $tripspends = TripBusSpend::where('id_trip_bus', $trip->id)->get();

        return view('frontend.driver.riwayat-pengeluaran.index', compact('trip', 'tripspends'));
    }
}
