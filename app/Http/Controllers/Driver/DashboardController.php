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
    //
    public function index()
    {
        // Ambil id driver yang sedang login
        $idDriver = Auth::id(); // Pastikan ini mengembalikan id driver

        $now = Carbon::now();
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
            ->whereHas('booking', function ($query) use ($now) {
                // Tampilkan data hanya jika waktu sekarang belum lebih dari 16 jam setelah date_start
                $query->where('date_start', '>=', $now->subHours(16)); // Tampilkan hingga 16 jam dari date_start
            })
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
