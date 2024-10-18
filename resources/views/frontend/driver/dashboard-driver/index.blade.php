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
                    <!-- <h4>Tidak ada booking berikutnya</h4> -->
                    <img src="{{ asset('img/notrip-image.png') }}" style="padding-top: 20px;">
                </div>
            @endif
            <!-- BUTTON -->
            @if ($continueTrips->isNotEmpty())
                <div class="mt-5">
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

            <!-- RIWAYAT TRIP -->
            <div class="mb-5" style="margin-bottom: 50px;">
                <div class="riwayat-title d-flex justify-content-between mt-5 mb-3">
                    <p>Riwayat Trip</p>
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
                <div class="riwayat-content accordion accordion-flush" id="item">
                    @foreach ($trips as $index => $trip)
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item{{ $trip->id }}" aria-expanded="false">
                                    <div class="riwayat-image">
                                        <img src="{{asset('img/pmj02-1.jpg')}}" class="img-fluid" width="60px" height="60px">
                                    </div>
                                    <div class="kode">
                                        <h5>{{ $trip->bus->name }}</h5>
                                        <p>{{ $trip->booking->booking_code }}</p>
                                    </div>
                                    <span class="ms-auto">
                                        <!-- <p>{{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F \p\u\k\u\l H.i') }} -->
                                        <p>Hari ini, 07 Oktober 2024<br>Pukul 15.00</p>
                                    </span>
                                </button>
                            </div>
                            <div id="item{{ $trip->id }}" class="accordion-collapse collapse" data-bs-parent="#item">
                                <div class="accordion-body">
                                    <div class="detail-trip">
                                        <div class="tabel-detail d-flex align-items-center">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="keterangan">Status</td>
                                                        <td>
                                                            <div class="status">
                                                                {{ $trip->booking->ms_booking->name }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan">Tanggal</td>
                                                        <td>
                                                            <div class="tgl">
                                                                {{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F Y') }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Customer</td>
                                                        <td>{{ $trip->booking->customer->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Nomor Telepon</td>
                                                        <td>{{ $trip->booking->customer->number_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Email</td>
                                                        <td>{{ $trip->booking->customer->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Titik Jemput</td>
                                                        <td>{{ $trip->booking->pickup_point }}</td>
                                                    </tr>
                                                    @foreach ($destinations[$index] as $dest)
                                                        <tr>
                                                            <td class="keterangan ">Tujuan 
                                                                @if ($loop->last)
                                                                    Akhir
                                                                @else
                                                                    {{ $loop->iteration }}</td>
                                                                @endif
                                                            <td>{{ $dest->name }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td class="keterangan ">Kapasitas</td>
                                                        <td>{{ $trip->bus->capacity }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    @foreach ($trip->tripbusspend as $spend)
                                        <div class="detail-pengeluaran">
                                            <div class="tabel-detail d-flex align-items-center">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">
                                                                Detail Pengeluaran Trip {{ $loop->iteration }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="keterangan">Nama Pengeluaran</td>
                                                            <td>{{ $spend->spend_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="keterangan ">Deskripsi</td>
                                                            <td>{{ $spend->description }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="keterangan ">Nominal</td>
                                                            <td>Rp {{ number_format($spend->nominal, 0, ',', '.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="keterangan ">Kilometer Speedometer</td>
                                                            <td>{{ $spend->kilometer }} KM</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="keterangan ">Bukti Pengeluaran</td>
                                                            <td>
                                                                <button type="button"
                                                                    onclick="modalBukti('{{ asset('storage/' . $spend->image_receipt) }}')"
                                                                    class="btn-bukti">
                                                                    <i class="fa-regular fa-eye"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
