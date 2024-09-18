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
            <div class="header mb-4">
                <p>Halo, Nida Aulia Karima!</p>
            </div>
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
                                    <i class="fa-solid fa-location-dot"></i>
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
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection