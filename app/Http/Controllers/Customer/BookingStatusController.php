<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Income;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class BookingStatusController extends Controller
{
    public function show($encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        $booking = Booking::findOrFail($id);
        $destinations = Destination::where('id_booking', $booking->id)->get();
        $encryptedId = Crypt::encryptString($booking->id);

        return view('frontend.booking-status.index', compact('booking', 'destinations', 'encryptedId'));
    }
    public function uploadProof(Request $request, $encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('cek.status')
                ->with('message', 'ID tidak valid.')
                ->with('alert-type', 'error');
        }

        $booking = Booking::findOrFail($id);

        // Store the uploaded file
        if ($request->hasFile('proof_of_payment_dp')) {

            $request->validate([
                'proof_of_payment_dp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'proof_of_payment_dp.required' => 'Bukti pembayaran DP wajib diunggah.',
                'proof_of_payment_dp.image' => 'Bukti pembayaran DP harus berupa gambar.',
                'proof_of_payment_dp.mimes' => 'Bukti pembayaran DP hanya boleh berupa file dengan format jpeg, png, atau jpg.',
                'proof_of_payment_dp.max' => 'Ukuran file bukti pembayaran DP tidak boleh lebih dari 2MB.',
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

            // return redirect()->back()
            return redirect()->route('cek.status')
                ->with([
                    'message' => 'Bukti pembayaran DP berhasil diunggah.',
                    'alert-type' => 'success',
                ]);
        } elseif ($request->hasFile('proof_of_payment_pelunasan')) {
            $request->validate([
                'proof_of_payment_pelunasan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'proof_of_payment_pelunasan.required' => 'Bukti pembayaran pelunasan wajib diunggah.',
                'proof_of_payment_pelunasan.image' => 'Bukti pembayaran pelunasan harus berupa gambar.',
                'proof_of_payment_pelunasan.mimes' => 'Bukti pembayaran pelunasan hanya boleh berupa file dengan format jpeg, png atau jpg.',
                'proof_of_payment_pelunasan.max' => 'Ukuran file bukti pembayaran pelunasan tidak boleh lebih dari 2MB.',
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

            // return redirect()->back()
            return redirect()->route('cek.status')
                ->with([
                    'message' => 'Bukti pembayaran pelunasan berhasil diunggah.',
                    'alert-type' => 'success',
                ]);
        }

        return redirect()->back()
            ->with([
                'message' => 'Gagal mengunggah bukti pembayaran.',
                'alert-type' => 'error',
            ]);
    }
}
