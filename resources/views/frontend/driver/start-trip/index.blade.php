@extends('frontend.layouts.app')
@push('styles')
    <title>Kilometer Awal</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/kmAwal-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardKm">
        <!-- HEADER -->
        <div class="dashboard-container container p-3">
            <x-header-driver />
            <!-- BUS IMAGE -->
            <div class="mt-5">
                <div class="img-bus d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ asset('storage/' . ($busImage ? $busImage->image : 'default-image.png')) }}" alt="bus">
                </div>
                <div class="tiket">
                    <div class="header-tiket ">
                        <p><img src="{{ asset('img/bus.png') }}"> PMJ Trans</p>
                    </div>
                    <div class="content-tiket">
                        <div class="tujuan">
                            <div class="row">
                                <div class="col">
                                    <p>{{ $booking->pickup_point }}</p>
                                    <h5>{{ $booking->pickup_point }}</h5>
                                </div>
                                <div class="col" style="text-align: right;">
                                    <p>{{ $booking->destination_point }}</p>
                                    <h5>{{ $booking->destination_point }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="waktu">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ \Carbon\Carbon::parse($booking->date_start)->format('H:i') }} WIB</h5>
                                    <p>{{ \Carbon\Carbon::parse($booking->date_start)->format('d M Y') }}</p>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-start">
                                    <img src="{{ asset('img/tiket-icon.png') }}">
                                </div>
                                <div class="col" style="text-align: right;">
                                    <h5>10.00 WIB</h5>
                                    <p>{{ \Carbon\Carbon::parse($booking->date_end)->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer-tiket">
                            <p>Durasi 1 Jam 15 Menit</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORM INPUT -->
            <div class="form-km p-3 mb-5">
                <form action="{{ route('km-start', $trip->id) }}" method="POST">
                    @csrf <!-- Tambahkan token CSRF -->
                    <div class="mb-3">
                        <label for="km_start" class="form-label">Kilometer Awal<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-gauge"></i></span>
                            <input type="text" class="form-control" id="km_start" name="km_start"
                                placeholder="Masukkan Kilometer Awal" required>
                        </div>
                        <small class="text-danger" id="error" style="display: none;">Masukkan data kilometer
                            awal.</small>
                    </div>
                    <!-- BUTTON -->
                    <div>
                        <button type="submit" class="btn-inputkm">Kirim</button>
                    </div>
                </form>

            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
