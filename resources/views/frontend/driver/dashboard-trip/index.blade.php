@extends('frontend.layouts.app')
@push('styles')
    <title>Input Data</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/inputData-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="inputData">
        <div class="dashboard-container container p-3">
            <!-- HEADER -->
            <x-header-driver />
            <!-- TEXT CONTENT -->
            <div class="text-content text-center mb-4">
                <h5 style="font-size: 25px; font-weight: 700; color: #1E9781;">DATA <span
                        style="color: #FD9C07;">PERJALANAN</span></h5>
                <p class="caption">Driver wajib mengisi data perjalanan dari mulai saat perjalanan hingga mengakhir
                    perjalanan.</p>
            </div>
            <!-- BUTTON -->
            <div class="p-3 mb-4">
                <div class="mb-3">
                    <a href="{{ route('spend-trip') }}">
                        <button class="btn-pengeluaran">
                            <div class="btn-container">
                                <div class="icon">
                                    <!-- <i class="fa-solid fa-dollar-sign"></i> -->
                                    <img src="{{ asset('img/icon-pengeluaran.png') }}">
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
                    <a href="{{ route('history-spend-trip') }}">
                        <button class="btn-riwayatTrip">
                            <div class="btn-container">
                                <div class="icon">
                                    <!-- <i class="fa-solid fa-clock"></i> -->
                                    <img src="{{ asset('img/icon-riwayat.png') }}">
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
                    <a href="{{ route('finish-trip') }}">
                        <button class="btn-end">
                            <div class="btn-container">
                                <div class="icon">
                                    <!-- <i class="fa-solid fa-flag"></i> -->
                                    <img src="{{ asset('img/icon-endtrip.png') }}">
                                </div>
                                <div class="text">
                                    <h6>Akhiri Trip</h6>
                                    <p>Masukan data saat trip selesai</p>
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
@endsection
