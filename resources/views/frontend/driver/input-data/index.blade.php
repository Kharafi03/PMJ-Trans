@extends('frontend.layouts.app')
@push('styles')
    <title>Input Data</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/inputData-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
<!-- CONTENT -->
    <section id="inputData">
        <div class="dashboard-container container p-3">
            <!-- HEADER -->
            <x-header-driver />
            <!-- TEXT CONTENT -->
            <div class="text-content text-center">
                <p class="title">DATA PERJALANAN</p>
                <p class="caption">Driver wajib mengisi data perjalanan dari mulai saat perjalanan hingga mengakhir perjalanan.</p>
            </div>
            <!-- BUTTON -->
            <div class="p-3 mb-4">
                <div class="mb-3">
                    <a href="{{ route('form-pengeluaran') }}">
                        <button class="btn-pengeluaran">
                            <div class="btn-container">
                                <div class="icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="text">
                                    <h6>Pengeluaran Saat Trip</h6>
                                    <p>Masukan data saat trip dimulai</p>
                                </div>
                            </div>
                        </button>
                    </a>
                </div>
                <div class="mb-3">
                    <a href="{{ route('end-trip') }}">
                        <button class="btn-end">
                            <div class="btn-container">
                                <div class="icon">
                                    <i class="fa-solid fa-circle"></i>
                                </div>
                                <div class="text">
                                    <h6>Akhiri Trip</h6>
                                    <p>Masukan data saat trip selesai</p>
                                </div>
                            </div>
                        </button>
                    </a>
                </div>  
                
                <!-- TOMBOL INI MUNCUL KETIKA DRIVER INGIN MELANJUTKAN PERJALANAN -->
                <div class="mb-3">
                    <a href="{{ route('form-pengeluaran') }}">
                        <button class="btn-riwayatTrip">
                            <div class="btn-container">
                                <div class="icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="text">
                                    <h6>Riwayat Trip</h6>
                                    <p>Riwayat Trip saat On Trip</p>
                                </div>
                            </div>
                        </button>
                    </a>
                </div>
                <div class="mb-3">
                    <a href="{{ route('form-pengeluaran') }}">
                        <button class="btn-lanjutPengeluaran">
                            <div class="btn-container">
                                <div class="icon">
                                    <i class="fa-solid fa-circle"></i>
                                </div>
                                <div class="text">
                                    <h6>Lanjutkan Trip</h6>
                                    <p>Klik di sini untuk lanjutkan trip</p>
                                </div>
                            </div>
                        </button>
                    </a>
                </div>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
     </section>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection