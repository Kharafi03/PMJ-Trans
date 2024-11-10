<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripBus;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Destination;
use App\Models\Bus;

class StartTripController extends Controller
{
    //

    // public function index($tripId, $bookingId)
    public function index()
    {
        // Ambil id driver yang sedang login
        $idDriver = Auth::id(); // Pastikan ini mengembalikan id driver

        $now = Carbon::now();

        // Ambil data trip bus yang sesuai
        $trip = TripBus::with('booking.ms_booking') // Memuat data booking dan msBooking
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
                // Menambahkan logika untuk memeriksa apakah trip dimulai hari ini atau dalam rentang waktu sekarang
                $query->where(function($query) use ($now) {
                    $query->whereDate('date_start', '=', $now->toDateString())  // Memeriksa apakah trip dimulai hari ini
                        ->orWhere(function($query) use ($now) {
                            $query->where('date_start', '<=', $now)  // Memeriksa jika trip sudah dimulai
                                ->where('date_end', '>=', $now);  // Memeriksa jika trip belum berakhir
                        });
                });
            })
            ->first();

        // Jika trip tidak ditemukan, kembalikan ke halaman utama dengan pesan
        if (!$trip) {
            return redirect()->route('dashboard-driver')->with([
                'message' => 'Anda tidak mempunyai trip aktif!',
                'alert-type' => 'error'
            ]);
        }

        $destinations = Destination::where('id_booking', $trip->booking->id)->get();

        // Ambil data booking yang terkait dengan trip
        $booking = $trip->booking;

        // Ambil gambar bus yang terkait dengan trip
        $busImage = $trip->bus->images()->first();

        // Hapus flag setelah mengakses halaman
        session()->forget('scanned');


        // Kirim data ke view
        return view('frontend.driver.start-trip.index', compact('trip', 'booking', 'busImage', 'destinations'));
    }




    public function kmStart(Request $request, $tripId)
    {
        // Validasi input
        $request->validate([
            'km_start' => 'required|numeric',
        ]);

        // Temukan trip berdasarkan ID
        $trip = TripBus::findOrFail($tripId);

        // Update km_start
        $trip->km_start = $request->km_start;
        $trip->id_ms_trip = 2; // Mengubah id_ms_trip menjadi Dalam Perjalanan
        $trip->save();

        // Update id_ms_user
        $driver = User::where('id', $trip->id_driver)->first();
        $driver->id_ms = 3; // Mengubah id_ms menjadi Dalam Perjalanan
        $driver->save();

        // Update id_ms_codriver
        $codriver = User::where('id', $trip->id_codriver)->first();
        $codriver->id_ms = 3;
        $codriver->save();

        // Update id_ms_bus pada bus yang terkait
        // $bus = $trip->bus; // Ambil objek bus melalui relasi
        // if ($bus) {
        //     $bus->ms_buses_id = 3; // Mengubah ms_buses_id menjadi Tersewa
        //     $bus->save();
        // } else {
        //     return redirect()->back()->with([
        //         'message' => 'Bus tidak ditemukan!',
        //         'alert-type' => 'error'
        //     ]);
        // }

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard-trip')
            ->with([
                'message' => 'Kilometer awal ditambahkan!',
                'alert-type' => 'success'
            ]);
    }
}
