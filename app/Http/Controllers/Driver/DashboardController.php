<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripBus;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Destination;

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

        $destinations = $trips->map(function ($trip) {
            // Mengambil destination berdasarkan id_booking yang ada pada setiap trip
            return Destination::where('id_booking', $trip->booking->id)->get();
        });

        $historyTrips = TripBus::with(['tripbusspend', 'bus', 'booking']) // Eager loading tripbusspend dan bus
            ->where('id_ms_trip', 3) // Hanya trip yang terkait dengan id_ms_trip 3
            ->where(function ($query) use ($idDriver) {
                // Grup kondisi untuk id_driver dan id_codriver
                $query->where('id_driver', $idDriver)
                    ->orWhere('id_codriver', $idDriver);
            })
            ->get();

        $historyDestinations = $historyTrips->map(function ($historyTrip) {
            // Mengambil destination berdasarkan id_booking yang ada pada setiap trip
            return Destination::where('id_booking', $historyTrip->booking->id)->get();
        });

        return view('frontend.driver.dashboard-driver.index', compact('trips', 'continueTrips', 'destinations', 'historyTrips', 'historyDestinations'));
    }
}
