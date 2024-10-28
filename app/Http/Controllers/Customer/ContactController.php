<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'namaLengkap' => 'required|string|max:255',
            'kategori' => 'required|string',
            'noTelp' => 'nullable|numeric|max:15',
            'email' => 'nullable|email|max:255',
            'pesan' => 'required|string',
        ], [
            'namaLengkap.required' => 'Nama lengkap wajib diisi.',
            'namaLengkap.string' => 'Nama lengkap harus berupa teks.',
            'namaLengkap.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.string' => 'Kategori harus berupa teks yang valid.',
            
            'noTelp.numeric' => 'Nomor telepon harus berupa angka.',
            'noTelp.max' => 'Nomor telepon tidak boleh lebih dari 15 digit.',
            
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.string' => 'Pesan harus berupa teks yang valid.',
        ]);

        if (!empty($validatedData['noTelp'])) {
            $validatedData['noTelp'] = $this->parsePhoneNumber($validatedData['noTelp']);
        }

        $generateChat = $this->generateChatTemplate(
            $validatedData['namaLengkap'],
            $validatedData['noTelp'],
            $validatedData['pesan']
        );

        // Menyimpan data ke dalam tabel 'mails'
        Mail::create([
            'name' => $validatedData['namaLengkap'],
            'phone' => $validatedData['noTelp'],
            'email' => $validatedData['email'],
            'category' => $validatedData['kategori'],
            'message' => $validatedData['pesan'],
            'template_chat' => $generateChat
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with([
            'message' => 'Pesan berhasil terkirim!',
            'alert-type' => 'success',
        ]);
    }

    private function generateChatTemplate($nama, $noTelp, $pesan)
    {
        $template = "Halo {$nama},\n";
        $template .= "Terima kasih atas pesan Anda. Kami akan segera menghubungi Anda";

        // Jika nomor telepon ada, masukkan ke dalam template
        if (!empty($noTelp)) {
            $template .= " di nomor telepon: {$noTelp}.";
        }

        $template .= "\nPesan Anda: {$pesan}";

        return $template;
    }

    private function parsePhoneNumber($noTelp)
    {
        // Jika nomor telepon dimulai dengan '08', ubah menjadi '628'
        if (substr($noTelp, 0, 2) === '08') {
            $noTelp = '628' . substr($noTelp, 2);
        }

        return $noTelp;
    }
}
