@extends('frontend.layouts.app')
@push('styles')
    <title>Booking</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesanan-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- CONTENT -->
    <!-- TITLE -->
    <section id="pemesanan">
        <div class="container mt-5">
            <h5><b>PEMESANAN</b></h5>
            <p class="caption">Pilih jadwal, destinasi, serta tipe kendaraan yang sesuai dengan kebutuhan Anda. Rasakan
                pengalaman perjalanan yang nyaman bersama layanan PMJ Trans</p>
        </div>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <li class="text-white">{{ $error }}</li>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- FORM -->
    <section id="form">
        <div class="container">
            <form id="formPemesanan" action="{{ route('booking.store') }} " method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6" style="padding: 40px;">
                        <div class="text-content">
                            <h5><b>Detail Pemesanan</b></h5>
                            <p class="caption">Silahkan isi formulir detail pemesanan di bawah ini untuk melakukan pemesanan
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="destination_point" class="form-label"><b>Tujuan</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="destination_point"
                                        name="destination_point" placeholder="Masukkan tujuan perjalanan" required
                                        autofocus>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-location-dot"></i></span>
                                </div>
                                <small class="text-danger" id="error-tujuan" style="display: none;">Lengkapi data tujuan
                                    anda.</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="capacity" class="form-label"><b>Kapasitas Bus</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="detail-pemesanan form-control" id="capacity"
                                        name="capacity" placeholder="Masukkan kapasitas penumpang" required>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-person"></i></i></span>
                                </div>
                                <small class="text-danger" id="error-kapasitas" style="display: none;">Lengkapi data
                                    kapasitas penumpang.</small>
                            </div>
                            <div class="mb-4">
                                <label for="date_start" class="form-label"><b>Tanggal Mulai</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="datetime-local" class="detail-pemesanan form-control" id="date_start"
                                        name="date_start" required>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-calendar"></i></span>
                                </div>
                                <small class="text-danger" id="error-tglmulai" style="display: none;">Lengkapi tanggal mulai
                                    perjalanan anda.</small>
                            </div>
                            <div class="mb-4">
                                <label for="date_end" class="form-label"><b>Tanggal Selesai</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="date" class="detail-pemesanan form-control" id="date_end"
                                        name="date_end" required>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-calendar"></i>
                                    </span>
                                </div>
                                <small class="text-danger" id="error-tglselesai" style="display: none;">Lengkapi tanggal
                                    selesai perjalanan anda.</small>
                            </div>
                            <!-- <div class="col-md-6 mb-4">
                                <label for="waktuJemput" class="form-label"><b>Waktu Jemput</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="time" class="detail-pemesanan form-control" id="waktuJemput" required>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-clock"></i></span>
                                </div>
                                <small class="text-danger" id="error-waktujemput" style="display: none;">Lengkapi waktu
                                    penjemputan.</small>
                            </div> -->
                            <div class="col-md-6 mb-4">
                                <label for="jmlArmada" class="form-label"><b>Jumlah Bus</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="detail-pemesanan form-control" id="fleet_amount"
                                        name="fleet_amount" placeholder="Masukkan jumlah armada" min="1" required>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-bus"></i></span>
                                </div>
                                <small class="text-danger" id="error-jmlarmada" style="display: none;">Lengkapi jumlah
                                    armada yang dibutuhkan.</small>
                            </div>
                            <div class="mb-4">
                                <label for="pickup_point" class="form-label"><b>Titik Jemput</b><span
                                        class="text-danger">*</span></label>
                                <div>
                                    <textarea class="form-control" placeholder="Masukkan alamat lengkap" id="pickup_point" name="pickup_point"
                                        style="height: 100px;" required></textarea>
                                </div>
                                <small class="text-danger" id="error-titikjemput" style="display: none;">Lengkapi alamat
                                    titik jemput anda.</small>
                            </div>
                            <div>
                                <p class="text-danger" style="font-size:18px;">*Wajib Diisi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" style="padding: 40px;">
                        <div class="text-content">
                            <h5><b>Detail Kontak</b></h5>
                            <p class="caption">Silahkan lengkapi formulir detail kontak di bawah ini untuk melakukan
                                pemesanan</p>
                        </div>
                        <div class="row">
                            <div class="mb-4">
                                <label for="name" class="form-label"><b>Nama Lengkap</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="name"
                                        name="name" placeholder="Masukkan nama lengkap"
                                        required>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-user"></i></i></span>
                                </div>
                                <small class="text-danger" id="error-nama" style="display: none;">Lengkapi data nama
                                    lengkap anda.</small>
                            </div>
                            <div class="mb-4">
                                <label for="number_phone" class="form-label"><b>Nomor Telephone</b><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="number_phone"
                                        name="number_phone" placeholder="Masukkan nomor telepon aktif dan dapat dihubungi."
                                        required>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-phone"></i></i></span>
                                </div>
                                <small class="text-danger" id="error-notelp" style="display: none;">Lengkapi data nomor
                                    telepon anda.</small>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label"><b>Email</b></label>
                                <div class="input-group">
                                    <input type="email" class="detail-pemesanan form-control" id="email"
                                        name="email" placeholder="Masukkan alamat email">
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-envelope"></i></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label"><b>Alamat</b><span
                                        class="text-danger">*</span></label>
                                <div>
                                    <textarea class="form-control" placeholder="Alamat Lengkap" id="address" name="address" style="height: 100px"
                                        required></textarea>
                                </div>
                                <small class="text-danger" id="error-alamat" style="display: none;">Lengkapi data alamat
                                    anda.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-end">
                    <button type="submit" class="btn-pemesanan">Kirim</button>
                </div>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />


    <!-- SCRIPT -->
    <script></script>
@endsection
