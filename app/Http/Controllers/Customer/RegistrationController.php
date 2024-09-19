<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Handle the registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input form
        $this->validator($request->all())->validate();

        // Simpan data user baru
        $user = $this->create($request->all());

        // Login otomatis setelah registrasi berhasil
        Auth::login($user); // Menggunakan Auth::login

        // Redirect ke halaman dashboard atau sesuai keinginan
        return redirect()->route('homepage')
            ->with('message', 'Registrasi Berhasil!')
            ->with('alert-type', 'success');
    }

    /**
     * Validasi data yang diterima.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'number_phone' => ['required', 'string', 'max:15', 'unique:users,number_phone'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Buat user baru setelah validasi berhasil.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'number_phone' => $data['number_phone'],
            'password' => Hash::make($data['password']),
            'id_ms' => 1,
        ]);
    }
}