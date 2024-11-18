@extends('frontend.layouts.app')
@push('styles')
    <title>Booking Status</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/statusPemesanan-style.css') }}" rel="stylesheet" />

@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />
    
    <!-- CONTENT -->
    <section id="statusPemesanan">
        <div class="container mb-5 mt-5">
            <!-- CARD -->
            <div class="card-form mb-3">
                <div class="row">
                    <!-- HEADER -->
                    <div class="col-md-12 col-lg-6 mb-3 d-flex flex-column justify-content-center wow animate__animated animate__fadeInLeft">
                        <div class="text-content">
                            <h1 class="mb-4">Cek <span>Pemesanan</span></h1>
                            <p>Cek status pemesanan dengan mengisikan kode booking dan nomor whatsapp yang digunakan saat menyewa bus</p>
                        </div>
                        <img src="{{asset('img/cek-img.png')}}" class="img-fluid" alt="images" style="padding: 0px 50px 0px 50px;">
                    </div>
                    <!-- FORM -->
                    <div class="col-md-12 col-lg-6 mb-3 p-3 wow animate__animated animate__fadeInRight">
                        <div class="form-content">
                            <form id="formStatusPemesanan" action="{{ route('post.cek.status') }}" method="POST">
                                @csrf
                                <div class="form-header text-center mb-4">
                                    <h5 style="font-size: 30px; font-weight: 700; color: #1E9781; font-family: 'Poppins', sans-serif;">Cek <span style="color: #FD9C07;">Pemesanan</span></h5>
                                </div>
                                <div class="kolom-input text-left" style="height: 100%;">
                                    <div class="mb-4">
                                        <label for="booking_code" class="form-label">Kode Booking<span class="text-danger">*</span></label>
                                        <div class="input-group d-flex justify-content-center">
                                            <span class="input-group-text" id="icon"><i class="fa-solid fa-ticket-simple"></i></span>
                                            <input type="text" id="booking_code" class="form-control" name="booking_code" placeholder="Masukkan kode booking" required>
                                        </div>
                                        <small class="text-danger" id="error-kode" style="display: none;">Masukkan kode booking yang telah diterima.</small> <!-- tak tambahin dulu jaga2 -->
                                    </div>
                                    <div class="mb-3">
                                        <label for="number_phone" class="form-label">Nomor WhatsApp<span class="text-danger">*</span></label>
                                        <div class="input-group d-flex justify-content-center">
                                            <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-wa.png') }}" alt="icon-wa" style="width:20px; height:20px; padding-left: 3px;"></span>
                                            <input type="text" id="number_phone" class="form-control" name="number_phone" placeholder="Masukkan nomor whatsapp aktif" required>
                                        </div>
                                        <small class="text-danger" id="error-notelp" style="display: none;">Masukkan nomor whatsapp aktif anda.</small>
                                    </div>
                                    <div class="form-footer">
                                        <p>Penting: Pastikan data yang dimasukan sudah benar</p>
                                    </div>
                                    <!-- BUTTON -->
                                    <div class="mt-5">
                                        <button type="submit" class="btn-cek">Cek</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />

    @push('scripts')
        <script>
            new WOW().init();
        </script>
    @endpush

@endsection
