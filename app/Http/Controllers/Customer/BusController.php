<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Review;
use Illuminate\Http\Request;

class BusController extends Controller
{
    //
    public function index()
    {
        // Mengambil semua data bus yang relasi ms_buses memiliki id = 1
        $buses = Bus::whereHas('ms_buses', function ($query) {
            $query->where('id', 1); // 'id' sesuai dengan kolom primary key di tabel ms_buses
        })
            ->with('images')
            ->get();

        // Array untuk menyimpan bus dan rating
        $busesWithRatings = [];

        foreach ($buses as $bus) {
            // Ambil review terkait dengan bus ini melalui booking dan tripbus
            $reviews = Review::whereHas('booking.tripbus', function ($query) use ($bus) {
                $query->where('id_bus', $bus->id);
            })
            ->get();

            // Hitung total rating jika ada review
            $totalStar = $reviews->isNotEmpty() ? $reviews->sum('rating') : 0;
            $averageStar = $reviews->isNotEmpty() ? $totalStar / $reviews->count() : 0;

            // Format rata-rata rating
            $formatStar = number_format($averageStar, 1);

            // Tambahkan bus dan rata-ratanya ke dalam array
            $busesWithRatings[] = [
                'bus' => $bus,
                'average_rating' => $formatStar,
            ];
        }

        // dd($busesWithRatings);

        return view('frontend.bus.index', compact('buses', 'busesWithRatings'));
    }

    public function show($bus_name)
    {
        $bus = Bus::whereHas('ms_buses', function ($query) {
            $query->where('id', 1); // 'id' sesuai dengan kolom primary key di tabel ms_buses
        })
            ->with('images')
            ->where('name', $bus_name)
            ->first();

        if (!$bus) {
            abort(404);
        }

        // Ambil review terkait dengan bus ini
        $reviews = Review::whereHas('booking.tripbus', function ($query) use ($bus) {
            $query->where('id_bus', $bus->id);
        })
            ->with(['booking.tripbus.bus'])
            ->get();

        $totalStar = $reviews->average('rating');
        
        $formatStar = number_format($totalStar, 1);

        return view('frontend.bus-detail.index', compact('bus', 'reviews', 'formatStar'));
    }
}
