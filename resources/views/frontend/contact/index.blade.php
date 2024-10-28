@extends('frontend.layouts.app')
@push('styles')
    <title>Contact</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/hubungiKami-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- Header Start -->
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="mb-4" style="font-size: 44px; font-weight: 700; color: #1E9781;">
                    Kontak 
                    <span style="color: #FD9C07;">Kami</span>
                </h1>
                <p class="mb-4" style="font-size: 16px; font-weight: 500; color: #666666B5;">
                    Untuk informasi lebih lanjut, silakan hubungi kami melalui kontak yang tersedia di halaman Kontak Kami.
                </p>
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('img/contact-img.png') }}" style="width: 100%; height: 100%; align-items:center; padding: 30px;" alt="gambar">
            </div>
        </div>
    </div>

    <!-- CONTACT -->
    <section id="contact">
        <div class="container mb-5">
            <!-- ICON CARD -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 d-flex p-3 mx-auto">
                    <div class="card contact-card flex-fill text-center border">
                        <div class="icon p-3">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="card-body flex-column">
                            <h5 class="card-title">Nomor WhatsApp</h5>
                            <p class="card-text">{{ $setting->contact ? $setting->contact : '#' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 d-flex p-3 mx-auto">
                    <div class="card contact-card flex-fill text-center border">
                        <div class="icon p-3">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Email</h5>
                            <p class="card-text">{{ $setting->email ? $setting->email : '#' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 d-flex p-3 mx-auto">
                    <div class="card contact-card flex-fill text-center border">
                        <div class="icon p-3">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Lokasi</h5>
                            <p class="card-text">{{ $setting->address ? $setting->address : '#' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 d-flex p-3 mx-auto">
                    <div class="card contact-card flex-fill text-center border">
                        <div class="icon p-3">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Jam Buka</h5>
                            <p class="card-text">{{ $setting->open_hours ? $setting->open_hours : '#' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FORM -->
    <section id="contact-form">
        <div class="container mt-5 mb-5">
            @include('frontend.assets.alert')
            <div class="row mt-5">
                <div class="col-lg-6 mb-3">
                    <form id="formHubungiKami" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form-header">
                            <p>Kontak Kami</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="namaLengkap" class="form-label">Nama Lengkap<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="namaLengkap" name="namaLengkap" placeholder="Masukkan nama lengkap" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="kategori" class="form-label">Kategori<span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Pertanyaan">Pertanyaan</option>
                                    <option value="Komplain">Komplain</option>
                                </select>
                                @error('kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="noTelp" class="form-label">Nomor WhatsApp<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('noTelp') is-invalid @enderror" id="noTelp" name="noTelp" placeholder="Masukkan nomor whatsapp" required>
                                @error('noTelp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan alamat email" name="email">
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="mt-3">
                                <label for="pesan" class="form-label">Pesan<span class="text-danger">*</span></label>
                                <textarea class="form-control @error('pesan') is-invalid @enderror" id="pesan" rows="3" placeholder="Tuliskan Pesan yang ingin disampaikan..." required name="pesan"></textarea>
                                @error('pesan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <p class="text-danger">*Wajib Diisi.</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn-kirim">Kirim Pesan</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 mb-3 d-flex justify-content-center">
                    <iframe 
                        src="{{ $setting->maps ? $setting->maps : 'about:blank' }}" 
                        allowfullscreen 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />

@endsection