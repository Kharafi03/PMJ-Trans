<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripBus;
use App\Models\Booking; // Pastikan Anda mengimpor model Booking
use App\Models\MSpend;
use App\Models\TripBusSpend;
use Illuminate\Support\Facades\Auth;

class SpendTripController extends Controller
{
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

        $spends = MSpend::all();

        return view('frontend.driver.pengeluaran.index', compact('trip', 'spends'));
    }

    public function store(Request $request, $tripId)
    {
        $request->validate([
            'id_m_spend' => 'required|exists:m_spends,id',
            'description' => 'required|string',
            'nominal' => 'required|numeric',
            'kilometer' => 'required|numeric',
            'image_receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ], [
            'image_receipt.image' => 'File harus berupa gambar.',
            'image_receipt.mimes' => 'File harus berupa jpeg, png, atau jpg.',
            'image_receipt.max' => 'File tidak boleh lebih dari 2MB.',
            'image_receipt.required' => 'Bukti pembayaran harus diunggah.',
            'nominal.required' => 'Nominal harus diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'nominal.min' => 'Nominal harus lebih dari 0.',
            'kilometer.required' => 'Kilometer harus diisi.',
            'kilometer.numeric' => 'Kilometer harus berupa angka.',
            'kilometer.min' => 'Kilometer harus lebih dari 0.',
            'description.required' => 'Deskripsi harus diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'id_m_spend.required' => 'Pengeluaran harus dipilih.',
            'id_m_spend.exists' => 'Pengeluaran tidak valid.',
        ]);

        // update trip_buses kolom total_spend
        $trip = TripBus::findOrFail($tripId);
        $trip->total_spend += $request->nominal;
        $trip->nominal -= $request->nominal;

        if ($request->id_m_spend == 1) {
            $trip->total_spend_bbm += $request->nominal;
        }

        $trip->save();

        // Menyimpan file gambar
        $imagePath = $request->file('image_receipt')->store('image_receipt', 'public');

        // Simpan data ke tabel trip_bus_spend
        TripBusSpend::create([
            'id_trip_bus' => $tripId,
            'id_m_spend' => $request->id_m_spend,
            'description' => $request->description,
            'nominal' => $request->nominal,
            'kilometer' => $request->kilometer,
            'image_receipt' => $imagePath,
            'datetime' => now(),
            'latitude' => $request->latitude ?? null,
            'longitude' => $request->longitude ?? null,
        ]);

        

        return redirect()->route('dashboard-trip')->with([
            'message' => 'Pengeluaran ditambahkan!',
            'alert-type' => 'success'
        ]);
    }
}
