@extends('frontend.layouts.app')
@push('styles')
    <title>Customer Profile</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/profilCustomer-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />
    
    <!-- CUSTOMER PROFIL -->
    <section id="profil">
        <div class="container mt-5">
            <div class="row d-flex align-items-stretch">
                <!-- AVATAR -->
                <div class="mb-3">
                    <h1 style="font-size: 44px; font-weight: 700; color: #1E9781;">Ubah <span style="color: #FD9C07;">Profile</span></h1>
                </div>
                <div class="col-md-4 mb-3 d-flex">
                    <div class="profil-image card h-100 w-100">
                        <h5>Foto Profil</h5>
                        <p>Photo</p>
                        <div class="avatar text-center">
                            <img src="{{ asset('img/avatar.png') }}" class="img-fluid" alt="avatar">
                        </div>
                    </div>
                </div>
                <!-- FORM -->
                <div class="col-md-8 mb-3 d-flex">
                    <div class="profil-form card h-100 w-100">
                        <form id="formProfilCustomer" action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="number_phone" class="form-label">Nomor WhatsApp<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="number_phone" name="number_phone" placeholder="Masukkan nomor whatsapp" value="{{ $user->number_phone }}" required>
                            </div> 
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email" value="{{ $user->email }}">
                            </div> 
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap" required>{{ $user->address }}</textarea>
                            </div>
                            <button type="submit" class="btn-profil">Perbarui Profil</button>
                        </form>                         
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="note">
                        <p>Keterangan : <span class="text-danger">Wajib diisi (*)</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />

@endsection
