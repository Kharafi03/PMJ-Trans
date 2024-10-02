<?php
namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripBus;
use Illuminate\Support\Facades\Auth;

class HistoryTripController extends Controller
{
    /**
     * Menampilkan riwayat trip beserta trip spend dan data bus.
     */
    public function index()
    {
        $userId = Auth::id();

        // Mengambil semua trip beserta spends dan bus yang terkait
        $trips = TripBus::with(['tripbusspend', 'bus']) // Eager loading tripbusspend dan bus
            ->where('id_ms_trip', 3) // Hanya trip yang terkait dengan id_ms_trip 3
            ->where(function ($query) use ($userId) {
                // Grup kondisi untuk id_driver dan id_codriver
                $query->where('id_driver', $userId)
                    ->orWhere('id_codriver', $userId);
            })
            ->get();

        // dd($trips);

        // Mengirim data trip beserta spends dan bus ke tampilan
        return view('frontend.driver.trip-history.index', compact('trips'));
    }
}
