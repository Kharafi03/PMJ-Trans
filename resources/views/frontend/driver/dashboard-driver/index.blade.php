@extends('frontend.layouts.app')
@push('styles')
    <title>Dashboard Driver</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/dashboardDriver-style.css') }}" rel="stylesheet">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboard">

        <!-- HEADER -->
        <div class="dashboard-container container p-3">
            <x-header-driver />

            @if ($continueTrips->isNotEmpty())
                <div class="text-content">
                    <p>Hati-hati dalam perjalanan!</p>
                </div>
                <div class="title">
                    <p>Jangan lupa selalu mengisi data perjalanan!</p>
                </div>
            @elseif (
                $trips->filter(function ($trip) {
                        return \Carbon\Carbon::parse($trip->booking->date_start)->isToday();
                    })->count() == 0)
                <div class="text-content">
                    <p>Wahh.. Hari ini belum ada trip!</p>
                </div>
                <div class="title">
                    <p>Tidak ada booking untuk hari ini</p>
                </div>
            @else
                <!-- TEXT CONTENT -->
                <div class="text-content">
                    <p>Semangat.. Hari ini ada trip!</p>
                </div>

                <!-- TITLE -->
                <div class="title">
                    <p>Booking yang akan datang</p>
                </div>
            @endif

            @if ($trips->count() > 0)
                <!-- CARD -->
                <div class="card-content">
                    @foreach ($trips as $trip)
                        <div class="banner"
                            style="background-image: url('{{ \Carbon\Carbon::parse($trip->booking->date_start)->isToday() ? asset('img/banner2.png') : asset('img/banner1.png') }}');">
                            <div class="banner-isi">
                                <div class="header">
                                    @if (\Carbon\Carbon::parse($trip->booking->date_start)->isToday())
                                        <p style="padding-top: 1rem; font-weight: 600; font-size: 14px;"
                                            class="text-center">
                                            Hari ini,
                                            {{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F \p\u\k\u\l H.i') }}
                                        </p>
                                    @else
                                        <p style="padding-top: 1rem; font-weight: 600; font-size: 14px;"
                                            class="text-center">
                                            {{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F \p\u\k\u\l H.i') }}
                                        </p>
                                    @endif
                                    <div class="kode">
                                        <p>{{ $trip->booking->booking_code }}</p>
                                        <h5>{{ $trip->bus->name }}</h5>
                                    </div>
                                </div>
                                <div class="row tujuan">
                                    <div class="col-4 col-md-6 col-lg-4">
                                        <p>{{ $trip->booking->pickup_point }}</p>
                                    </div>
                                    <div class="col-4 col-md-6 col-lg-4">
                                        <p>{{ $trip->booking->destination->last()->name }}</p>
                                    </div>
                                </div>
                                <a href="{{ url('/driver/detail-trip/' . $trip->booking->booking_code) }}"
                                    class="btn-lihat mt-3">Lihat</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- IMAGE -->
                <div class="image-content">
                    <h4>Tidak ada booking berikutnya</h4>
                    <img src="{{ asset('img/notrip-image.png') }}">
                </div>
            @endif
            <!-- BUTTON -->
            @if ($continueTrips->isNotEmpty())
                <div class="p-3">
                    <a href="{{ route('dashboard-trip') }}" class="btn-lanjut">Lanjutkan Trip</a>
                </div>
            @elseif (
                $trips->filter(function ($trip) {
                        $dateStart = \Carbon\Carbon::parse($trip->booking->date_start);
                        $dateEnd = \Carbon\Carbon::parse($trip->booking->date_end);
                        $now = \Carbon\Carbon::now();
            
                        // Memeriksa apakah waktu sekarang berada di antara date_start dan date_end
                        return $dateStart->isToday() || $now->between($dateStart, $dateEnd);
                    })->count() > 0)
                <div class="p-3">
                    <a href="{{ route('scan-trip') }}" class="btn-mulai">Mulai Trip</a>
                </div>
            @endif
            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
