@extends('frontend.layouts.app')
@push('styles')
    <title>Input Data</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/endTrip-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardEnd">
        <div class="dashboard-container container p-3">
            <!-- HEADER -->
            <!-- <x-header-driver /> -->
            
            <div class="text-content text-start mb-4">
                <!-- <h5 style="font-size: 25px; font-weight: 700; color: #1E9781;">Scan QR Code <span style="color: #FD9C07;">Driver</span></h5>
                <p class="caption">Silahkan Scan QR-Code diatas untuk memulai trip</p> -->
                <div class="row">
                    <div class="col-2" style="margin-right: -20px;">
                        <a href="{{ route('dashboard-trip') }}"><i class="fa-solid fa-chevron-left"></i></a>
                    </div>
                    <div class="col-10">
                        <h5 style="font-size: 20px; font-weight: 700; color: #1E9781;">Akhiri <span style="color: #FD9C07;">Trip</span></h5>
                        <p class="caption">Masukkan data saat trip selesai</p>
                    </div>
                </div>
            </div>

            <!-- FORM INPUT -->
            <div class="form-km p-3 mb-5 mt-5">
                <form id="formEndTrip" action="{{ route('km-end', $trip->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="endTrip" class="form-label">Kilometer Akhir<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-road-bridge"></i></span>
                            <input type="text" class="form-control" id="km_end" name="km_end" placeholder="Masukkan Kilometer Akhir" required>
                        </div>
                        <small class="text-danger" id="error" style="display: none;">Data harus diisi.</small>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn-endtrip">Kirim</button>
                    </div>
                </form>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>
@endsection
