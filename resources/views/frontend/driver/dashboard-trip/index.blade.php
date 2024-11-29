@extends('frontend.layouts.app')
@push('styles')
    <title>Input Data</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/inputData-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="inputData">
        <div class="dashboard-container container p-3">

            <!-- TEXT CONTENT -->
            <div class="text-content text-center mb-4">
                <h5 style="font-size: 25px; font-weight: 700; color: #1E9781;">DATA <span
                        style="color: #FD9C07;">PERJALANAN</span></h5>
                <p class="caption">Driver wajib mengisi data perjalanan dari mulai saat perjalanan hingga mengakhir
                    perjalanan.</p>
            </div>
            <!-- BUTTON -->
            <div class="p-3 mb-4">
                <div class="mb-4">
                    <a href="{{ route('spend-trip') }}">
                        <button class="btn-pengeluaran">
                            <div class="btn-container">
                                <div class="icon-btn">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                </div>
                                <div class="text d-flex align-items-center">
                                    <h6>Pengeluaran Saat Trip</h6>
                                </div>
                            </div>
                        </button>
                    </a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('history-spend-trip') }}">
                        <button class="btn-riwayatTrip">
                            <div class="btn-container">
                                <div class="icon-btn">
                                    <i class="fa-regular fa-folder-open" style="padding-left: 5px;"></i>
                                </div>
                                <div class="text d-flex align-items-center">
                                    <h6>Riwayat On Trip</h6>
                                </div>
                            </div>
                        </button>
                    </a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('finish-trip') }}">
                        <button class="btn-end">
                            <div class="btn-container">
                                <div class="icon-btn">
                                    <i class="fa-solid fa-circle"></i>
                                </div>
                                <div class="text d-flex align-items-center">
                                    <h6>Akhiri Trip</h6>
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
