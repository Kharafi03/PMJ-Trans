<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\TermsAndConditions;
use App\Models\Bus;
use App\Models\Review;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //

    public function index()
    {
        $faqs = Faq::all();
        $tacs = TermsAndConditions::all();
        $reviews = Review::inRandomOrder()->take(3)->get();
        $buses = Bus::whereHas('ms_buses', function ($query) {
            $query->where('id', 1); // 'id' sesuai dengan kolom primary key di tabel ms_buses
        })
        ->with('images')
        ->get();

        // Array untuk menyimpan bus dan rating
        $busesWithRatings = [];

        foreach ($buses as $bus) {
            // Ambil review terkait dengan bus ini melalui booking dan tripbus
            $review = Review::whereHas('booking.tripbus', function ($query) use ($bus) {
                $query->where('id_bus', $bus->id);
            })
            ->get();

            // Hitung total rating jika ada review
            $totalStar = $review->isNotEmpty() ? $review->sum('rating') : 0;
            $averageStar = $review->isNotEmpty() ? $totalStar / $review->count() : 0;

            // Format rata-rata rating
            $formatStar = number_format($averageStar, 1);

            // Tambahkan bus dan rata-ratanya ke dalam array
            $busesWithRatings[] = [
                'bus' => $bus,
                'average_rating' => $formatStar,
            ];
        }

        return view('frontend.homepage', compact('faqs', 'tacs', 'buses', 'reviews', 'busesWithRatings'));
    }
}