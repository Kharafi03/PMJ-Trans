<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripBus;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil id driver yang sedang login
        $idDriver = Auth::id(); // Pastikan ini mengembalikan id driver

        // Ambil tanggal hari ini
        // $today = Carbon::today(); // Menggunakan today() untuk mendapatkan tanggal hari ini tanpa waktu

        // Ambil data trip bus yang sesuai
        $trips = TripBus::with('booking.ms_booking') // Memuat data booking dan msBooking
            ->where(function ($query) use ($idDriver) {
                // Filter berdasarkan driver dan codriver
                $query->where('id_driver', $idDriver)
                    ->orWhere('id_codriver', $idDriver);
            })
            ->whereHas('booking.ms_booking', function ($query) {
                $query->where('name', 'Diterima'); // Filter untuk hanya menampilkan yang status "Diterima"
            })
            ->where('id_ms_trip', 1) // Tambahkan kondisi untuk id_ms_trip
            ->orderBy(
                Booking::select('date_start')
                    ->whereColumn('trip_buses.id_booking', 'bookings.id')
                    ->orderBy('date_start', 'asc')
                    ->limit(1)
            )
            ->get();

        $continueTrips = TripBus::with('booking.ms_booking') // Memuat data booking dan msBooking
            ->where(function ($query) use ($idDriver) {
                // Filter berdasarkan driver dan codriver
                $query->where('id_driver', $idDriver)
                    ->orWhere('id_codriver', $idDriver);
            })
            ->whereHas('booking.ms_booking', function ($query) {
                $query->where('name', 'Diterima'); // Filter untuk hanya menampilkan yang status "Diterima"
            })
            ->where('id_ms_trip', 2) // Tambahkan kondisi untuk id_ms_trip
            ->get();

        return view('frontend.driver.dashboard-driver.index', compact('trips', 'continueTrips'));
    }
}
