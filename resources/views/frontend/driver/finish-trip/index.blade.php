@extends('frontend.layouts.app')
@push('styles')
    <title>Input Data</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/endTrip-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardEnd">
        <div class="dashboard-container container p-3">
            <!-- HEADER -->
            <x-header-driver />
            <!-- TEXT CONTENT -->
            <div class="text-content text-center">
                <p class="title">DATA PERJALANAN</p>
            </div>
            <!-- BUTTON -->
            <div class="p-3 mb-4">
                <div class="mb-3">
                    <button class="btn-end" disabled>
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
                </div>
            </div>
            <!-- FORM INPUT -->
            <div class="form-km p-3 mb-5">
                <form id="formEndTrip" action="{{ route('km-end', $trip->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="endTrip" class="form-label">Kilometer Akhir<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-gauge"></i></span>
                            <input type="text" class="form-control" id="km_end" name="km_end" placeholder="Masukkan Kilometer Akhir"
                                required autofocus>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
