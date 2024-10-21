@extends('frontend.layouts.app')
@push('styles')
    <title>Dashboard Driver</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/dashboardDriver-style.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/frontend/css/driver/dashboardTrip-style.css') }}"> --}}
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
@endpush
@section('content')
    <section id="dashboard">
        <div class="dashboard-container container p-3">
            {{-- HEADER --}}
            <x-header-driver />

            {{-- TITLE --}}
            @if ($continueTrips->isNotEmpty())
                <div class="title">
                    <p class="mb-3" style="color: #ff0000">Jangan lupa selalu mengisi data perjalanan!</p>
                </div>
            @elseif (
                $trips->filter(function ($trip) {
                        return \Carbon\Carbon::parse($trip->booking->date_start)->isToday();
                    })->count() == 0
            )
                <div class="title mb-3">
                    <p>Wahh.. Hari ini belum ada trip!</p>
                    <h5 style="color: #ff0000">Tidak ada booking untuk hari ini</h5>
                </div>
            @else
                <div class="title mb-3">
                    <p>Semangat, hari ini ada trip!</p>
                    <h5 style="color: #1E9781">Hari ini kamu akan melakukan perjalanan.</h5>
                </div>
            @endif

            {{-- CARD CONTENT --}}
            @if ($trips->count() > 0)

                <div id="bannerCarousel" class="carousel slide" style="padding-bottom: 30px;" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($trips as $index => $trip)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }} p-1">
                            <div class="card-content">
                                <div class="content mb-2">
                                    <div class="banner" style="background-image: url('{{ \Carbon\Carbon::parse($trip->booking->date_start)->isToday() ? asset('img/bg-banner1.png') : asset('img/bg-banner2.png') }}');">
                                        <div class="@if (\Carbon\Carbon::parse($trip->booking->date_start)->isToday()) banner-header-sekarang @else banner-header-nanti @endif">
                                            @if (\Carbon\Carbon::parse($trip->booking->date_start)->isToday())
                                                <p>
                                                    Hari ini,
                                                    {{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F \p\u\k\u\l H.i') }}
                                                </p>
                                            @else
                                                <p>
                                                    {{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F \p\u\k\u\l H.i') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="row d-flex">
                                            <div class="col-7 col-md-7">
                                                <div class="banner-isi">
                                                    <div class="banner-kode">
                                                        <p>{{ $trip->booking->booking_code }}</p>
                                                        <h5>{{ $trip->bus->name }}</h5>
                                                    </div>
                                                    <div class="banner-tujuan d-flex justify-content-between">
                                                        <p>{{ Str::limit($trip->booking->pickup_point, 20, '...') }}</p>
                                                        <p>{{ Str::limit($trip->booking->destination->last()->name, 20, '...') }}</p>
                                                    </div>
                                                    <div class="banner-btn">
                                                        <a href="{{ url('/driver/detail-trip/' . $trip->booking->booking_code) }}" class="btn-detail">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5 col-md-5">
                                                <div class="banner-img d-flex justify-content-center align-items-center">
                                                    <img src="{{ \Carbon\Carbon::parse($trip->booking->date_start)->isToday() ? asset('img/banner1-img.png') : asset('img/banner2-img.png') }}" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        @foreach ($trips as $index => $trip)
                        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="image-content">
                    <img src="{{ asset('img/notrip-image.png') }}" style="padding-top: 20px;">
                </div>
            @endif

            <!-- RIWAYAT TRIP -->
            <div class="mb-5">
                <div class="riwayat-title d-flex justify-content-between align-items-center mt-3 mb-3">
                    <p class="mb-0">Riwayat Trip</p>
                    <i class="fa-solid fa-chevron-right"></i>
                </div>

                <div class="riwayat-content accordion accordion-flush mb-5" style="padding-bottom: 60px;" id="item">
                    @foreach ($historyTrips->sortByDesc('created_at')->take(3) as $index => $historyTrip)
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button class="accordion-button collapsed d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#item{{ $historyTrip->id }}" aria-expanded="false">
                                    <div class="riwayat-image me-3">
                                        <img src="{{ asset('storage/' . $historyTrip->bus->images->first()->image) }}" class="img-fluid" width="60" height="60" style="object-fit: cover;">
                                    </div>
                                    <div class="kode">
                                        <h5 class="mb-0">{{ $historyTrip->bus->name }}</h5>
                                        <p class="mb-0">{{ $historyTrip->booking->booking_code }}</p>
                                    </div>
                                    <span class="ms-auto">
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($historyTrip->booking->date_start)->translatedFormat('d F Y') }}</p>
                                        <p class="mb-0">Pukul {{ \Carbon\Carbon::parse($historyTrip->booking->date_start)->translatedFormat('H.i') }}</p>
                                    </span>
                                </button>
                            </div>                                                    
                            <div id="item{{ $historyTrip->id }}" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="detail-trip">
                                        <div class="tabel-detail d-flex align-items-center">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="keterangan">Status</td>
                                                        <td>
                                                            <div class="status">
                                                                {{ $historyTrip->booking->ms_booking->name }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan">Tanggal</td>
                                                        <td>
                                                            <div class="tgl">
                                                                {{ \Carbon\Carbon::parse($historyTrip->booking->date_start)->translatedFormat('d F Y') }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Customer</td>
                                                        <td>{{ $historyTrip->booking->customer->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Nomor Telepon</td>
                                                        <td>{{ $historyTrip->booking->customer->number_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Email</td>
                                                        <td>{{ $historyTrip->booking->customer->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Titik Jemput</td>
                                                        <td>{{ $historyTrip->booking->pickup_point }}</td>
                                                    </tr>
                                                    @foreach ($historyDestinations[$index] as $dest)
                                                        <tr>
                                                            <td class="keterangan ">Tujuan
                                                                @if ($loop->last)
                                                                    Akhir
                                                                @else
                                                                    {{ $loop->iteration }}
                                                            </td>
                                                                @endif
                                                            <td>{{ $dest->name }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td class="keterangan ">Jumlah Penumpang</td>
                                                        <td>{{ $historyTrip->booking->capacity }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- BUTTON CONTINUE TRIP -->
                <div class="text-center button-trip p-3">
                    @if ($continueTrips->isNotEmpty())
                        <div class="mb-5">
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
                        <div class="mb-5">
                            <a href="{{ route('scan-trip') }}" class="btn-mulai">Mulai Trip</a>
                        </div>
                    @endif
                </div>
            </div>

        <x-navbar-driver />

        </div>
    </section>
    
@endsection
