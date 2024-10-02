<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripBus;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StartTripController extends Controller
{
    //

    // public function index($tripId, $bookingId)
    public function index()
    {
        // Ambil ID user yang sedang login
        $driverId = Auth::id();

        // Tentukan batas waktu 16 jam yang lalu
        $maxLateTime = Carbon::now()->subHours(16);

        // Ambil trip dari tabel trip_buses yang memenuhi kriteria
        $trip = TripBus::whereHas('booking', function ($query) use ($maxLateTime) {
            // Ambil trip jika date_start adalah hari ini ATAU sudah lewat maksimal 16 jam yang lalu
            $query->whereDate('date_start', now()); // Ambil booking dengan date_start pada hari ini
                // ->orWhere('date_start', '>=', $maxLateTime); // Atau date_start yang maksimal 16 jam lalu
        })
            ->where(function ($query) use ($driverId) {
                // Cek apakah id_driver atau id_codriver adalah user yang login
                $query->where('id_driver', $driverId)
                    ->orWhere('id_codriver', $driverId);
            })
            ->where('id_ms_trip', 1) // Trip harus memiliki id_ms_trip = 1 (belum mulai)
            ->first(); // Ambil satu trip yang sesuai

        // Jika trip tidak ditemukan, kembalikan ke halaman utama dengan pesan
        if (!$trip) {
            return redirect()->route('dashboard-driver')->with([
                'message' => 'Anda tidak mempunyai trip aktif!',
                'alert-type' => 'error'
            ]);
        }

        // Ambil data booking yang terkait dengan trip
        $booking = $trip->booking;

        // Ambil gambar bus yang terkait dengan trip
        $busImage = $trip->bus->images()->first();

        // Hapus flag setelah mengakses halaman
        session()->forget('scanned');

        dd($trip, $booking, $busImage);
        // Kirim data ke view
        return view('frontend.driver.start-trip.index', compact('trip', 'booking', 'busImage'));
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
        $trip->id_ms_trip = 2;
        $trip->save();

        // Update id_ms_user
        $driver = User::where('id', $trip->id_driver)->first();
        $driver->id_ms = 3;
        $driver->save();

        // Update id_ms_codriver
        $codriver = User::where('id', $trip->id_codriver)->first();
        $codriver->id_ms = 3;
        $codriver->save();

        // Update id_ms_bus pada bus yang terkait
        $bus = $trip->bus; // Ambil objek bus melalui relasi
        if ($bus) {
            $bus->ms_buses_id = 3; // Update kolom ms_buses_id di model Bus
            $bus->save();
        } else {
            return redirect()->back()->with([
                'message' => 'Bus tidak ditemukan!',
                'alert-type' => 'error'
            ]);
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard-trip')
            ->with([
                'message' => 'Kilometer awal ditambahkan!',
                'alert-type' => 'success'
            ]);
    }
}
