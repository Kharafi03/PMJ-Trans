<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Income;
use Illuminate\Support\Str;

class BookingStatusController extends Controller
{
    public function uploadProof(Request $request, $id)
    {

        $booking = Booking::findOrFail($id);

        // Store the uploaded file
        if ($request->hasFile('proof_of_payment_dp')) {

            $request->validate([
                'proof_of_payment_dp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $file = $request->file('proof_of_payment_dp');
            $filename = Str::random(24) . '.' . $file->getClientOriginalExtension(); // Menggunakan hash untuk nama file
            $filename = strtoupper(Str::random(24)) . '.' . $file->getClientOriginalExtension(); // Generate a random string for the filename
            $file->storeAs('image_receipt', $filename, 'public'); // Store in storage/app/public/image_receipt

            // Create a new income record
            Income::create([
                'id_booking' => $booking->id,
                'id_m_income' => 1,
                'id_ms_income' => 1,
                'datetime' => now(),
                'image_receipt' => 'image_receipt/' . $filename, // Include the path in the database
                // Tambahkan field lain yang diperlukan di sini
            ]);

            return redirect()->back()
                ->with('message', 'Bukti DP berhasil diunggah.')
                ->with('alert-type', 'success');
        } elseif ($request->hasFile('proof_of_payment_pelunasan')) {
            $request->validate([
                'proof_of_payment_pelunasan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $file = $request->file('proof_of_payment_pelunasan');
            $filename = Str::random(24) . '.' . $file->getClientOriginalExtension(); // Menggunakan hash untuk nama file
            $filename = strtoupper(Str::random(24)) . '.' . $file->getClientOriginalExtension(); // Generate a random string for the filename
            $file->storeAs('image_receipt', $filename, 'public'); // Store in storage/app/public/image_receipt

            // Create a new income record
            Income::create([
                'id_booking' => $booking->id,
                'id_m_income' => 2,
                'id_ms_income' => 1,
                'datetime' => now(),
                'image_receipt' => 'image_receipt/' . $filename, // Include the path in the database
                // Tambahkan field lain yang diperlukan di sini
            ]);

            return redirect()->back()
                ->with('message', 'Bukti pelunasan berhasil diunggah.')
                ->with('alert-type', 'success');
        }

        return redirect()->back()->withErrors('Gagal mengupload bukti DP.');
    }
}
