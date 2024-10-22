@extends('frontend.layouts.app')
    <title>Detail Booking</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/detailRiwayat-style.css') }}" rel="stylesheet" />
@section('content')
    <x-navbar-customer />
    <section id="detailSewa" class="py-5">
        <div class="container mt-5">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <li class="text-white">{{ $error }}</li>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row justify-content-center py-3">
                <div class="col-md-6">
                    <div class="text-content mb-5">
                        <h5 style="font-size: 44px; font-weight: 700; color: #1E9781;">Detail <span style="color: #FD9C07;">Booking</span></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-hover table-striped align-middle">
                            <tbody>
                                <tr>
                                    <th scope="row">Booking Kode</th>
                                    <td>{{ $booking->booking_code }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status</th>
                                    <td>
                                        <!-- <span class="badge fs-6
                                            @if ($booking->ms_booking->id == 1) 
                                                bg-warning
                                            @elseif ($booking->ms_booking->id == 2)
                                                bg-success
                                            @elseif ($booking->ms_booking->id == 3)
                                                bg-danger
                                            @elseif ($booking->ms_booking->id == 4)
                                                bg-primary
                                            @elseif ($booking->ms_booking->id == 5)
                                                bg-danger @endif">
                                            {{ $booking->ms_booking->name }}
                                        </span> -->
                                        <span class="
                                            @if ($booking->ms_booking->id == 1) 
                                                draf
                                            @elseif ($booking->ms_booking->id == 2)
                                                diterima
                                            @elseif ($booking->ms_booking->id == 3)
                                                ditolak
                                            @elseif ($booking->ms_booking->id == 4)
                                                selesai
                                            @elseif ($booking->ms_booking->id == 5)
                                                dibatalkan @endif">
                                            {{ $booking->ms_booking->name }}
                                        </span>
                                        <!-- {{ $booking->ms_booking->name }} -->
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Penyewa</th>
                                    <td>{{ $booking->customer->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Titik Jemput</th>
                                    <td>
                                        {{ $booking->pickup_point }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tujuan</th>
                                    <td>
                                        @foreach ($destination as $dest)
                                            @if ($loop->count > 1)
                                                {{ $loop->iteration }}. {{ $dest->name }}
                                            @else
                                                {{ $dest->name }}
                                            @endif
                                            <br>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Penumpang</th>
                                    <td>{{ $booking->capacity }} penumpang</td>
                                </tr>
                                <tr>
                                    <th scope="row">Biaya</th>
                                    <td>
                                        @if ($booking->trip_nominal != null)
                                            Rp {{ number_format($booking->trip_nominal, 0, ',', '.') }}
                                        @else
                                            Tidak Ditemukan
                                        @endif
                                </tr>
                                <tr>
                                    <th scope="row">Minimum DP</th>
                                    <td>
                                        @if ($booking->minimum_dp != null)
                                            Rp {{ number_format($booking->minimum_dp, 0, ',', '.') }}
                                        @else
                                            Tidak Ditemukan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Pembayaran</th>
                                    <td>
                                        <!-- <span class="badge fs-6
                                            @if ($booking->ms_payment->id == 1) 
                                                bg-warning
                                            @elseif ($booking->ms_payment->id == 2)
                                                bg-success
                                            @elseif ($booking->ms_payment->id == 3)
                                                bg-info
                                            @elseif ($booking->ms_payment->id == 4)
                                                bg-primary @endif">
                                        {{ $booking->ms_payment->name }} -->
                                        <span class="
                                            @if ($booking->ms_payment->id == 1) 
                                                draf
                                            @elseif ($booking->ms_payment->id == 2)
                                                belumBayar
                                            @elseif ($booking->ms_payment->id == 3)
                                                sudahBayar
                                            @elseif ($booking->ms_payment->id == 4)
                                                lunas @endif">
                                            {{ $booking->ms_payment->name }}
                                        </span>
                                        <!-- {{ $booking->ms_payment->name }} -->
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Mulai</th>
                                    <td>{{ \Carbon\Carbon::parse($booking->date_start)->translatedFormat('l, d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Selesai</th>
                                    <td>
                                        @if ($booking->date_end == null)
                                            Tidak Ditemukan
                                        @else
                                            {{ \Carbon\Carbon::parse($booking->date_end)->translatedFormat('l, d F Y') }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div>
                        @if ($booking->ms_booking->id == 4)
                            <!-- <h3>Terima kasih telah menggunakan sewa bus kami! Sampai jumpa di pemesanan selanjutnya!
                            </h3> -->
                            <div>
                                <h1 style="font-size: 44px; font-weight: 700; color: #1E9781; margin-bottom: 5px;">Detail <span style="color: #FD9C07;">Ulasan</span></h1>
                                <p style="font-size: 20px; font-weight: 500; color: black;">Terima kasih telah menggunakan sewa bus kami! Sampai jumpa di pemesanan selanjutnya!</p>
                            </div>
                            <div class="col-md-12">
                                <!-- <div class="d-flex align-items-center mb-3" data-bs-toggle="collapse" href="#feedbackForm"
                                    aria-expanded="false">
                                    <div style="border-top: 1px solid #000; flex-grow: 1;"></div>
                                    <span class="btn btn-lihat mx-3">Lihat Ulasan <i class="fas fa-chevron-down"></i></span>
                                </div> -->
                                <div class="d-flex align-items-center mb-3" data-bs-toggle="collapse" href="#feedbackForm" aria-expanded="false">
                                    <div style="border-top: 1px solid #000; flex-grow: 1;"></div>
                                    <span class="btn btn-lihat mx-3">Lihat Ulasan&nbsp;<i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div id="feedbackForm" class="collapse">
                                    @if ($feedbacks->isNotEmpty())
                                        @foreach ($feedbacks as $feedback)
                                            <div id="feedbackForm" class="collapse">
                                                <h3 class="mt-4 mb-3">Ulasan Anda</h3>
                                                <div class="mb-3">
                                                    <textarea class="form-control bg-light" id="feedback" name="feedback" rows="3" required disabled>{{ $feedback->feedback }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rating">Rating</label>
                                                    <div class="rating-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $feedback->rating)
                                                                <span class="star" data-rating="{{ $i }}"><i
                                                                        class="fas fa-star text-warning"></i></span>
                                                            @else
                                                                <span class="star" data-rating="{{ $i }}"><i
                                                                        class="fas fa-star text-secondary"></i></span>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="text-content">
                                <h5 style="font-size: 32px; font-weight: 700; color: #1E9781;">Detail <span style="color: #FD9C07;">Pemesanan</span></h5>
                            </div>
                        </div>
                        <div class="col-md-5">
                            @if ($booking->ms_booking->id == 1)
                                <!-- <p class="mb-4">Silahkan menunggu admin mengkonfirmasi</p> -->
                                <p class="status-draf">Status Pemesanan : Diproses</p>
                                @elseif ($booking->ms_booking->id == 2)
                                    <!-- <p class="mb-4">Pemesanan 
                                        <span class="badge bg-success">
                                            Diterima
                                        </span>
                                    </p> -->
                                    <p class="status-diterima">Status Pemesanan : Diterima</p>
                                    @elseif ($booking->ms_booking->id == 3)
                                        <!-- <p class="mb-4">Pemesanan 
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>
                                        </p> -->
                                        <p class="status-ditolak">Status Pemesanan : Ditolak</p>
                                    @elseif ($booking->ms_booking->id == 4)
                                        <!-- <p class="mb-4">Pemesanan 
                                            <span class="badge bg-primary">
                                                Selesai
                                            </span>
                                        </p> -->
                                        <p class="status-selesai">Status Pemesanan : Selesai</p>
                                    @elseif ($booking->ms_booking->id == 5)
                                        <!-- <p class="mb-4">Pemesanan
                                            <span class="badge bg-danger">
                                                Dibatalkan
                                            </span>
                                        </p> -->
                                        <p class="status-dibatalkan">Status Pemesanan : Dibatalkan</p>
                            @endif
                            <!-- @if ($booking->ms_payment->id == 1)
                                <h4 class="mb-4">Status Pembayaran:
                                    <span class="badge bg-warning">
                                        {{ $booking->ms_payment->name }}
                                    </span>
                                </h4>
                            @elseif ($booking->ms_payment->id == 2)
                                <h4 class="mb-4">Status Pembayaran:
                                    <span class="badge bg-success">
                                        {{ $booking->ms_payment->name }}
                                    </span>
                                </h4>
                            @elseif ($booking->ms_payment->id == 3)
                                <h4 class="mb-4">Status Pembayaran: 
                                    <span class="badge bg-info">
                                        {{ $booking->ms_payment->name }}
                                    </span>
                                </h4>
                            @elseif ($booking->ms_payment->id == 4)
                                <h4 class="mb-4">Status Pembayaran: 
                                    <span class="badge bg-primary">
                                    {{ $booking->ms_payment->name }}
                                    </span>
                                </h4>
                            @endif -->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-7">
                            <div class="text-content">
                                <h5 style="font-size: 32px; font-weight: 700; color: #1E9781;">Detail <span style="color: #FD9C07;">Pembayaran</span></h5>
                            </div>
                        </div>
                        <div class="col-md-5">
                        @if ($booking->ms_payment->id == 1)
                                <!-- <h4 class="mb-4">Status Pembayaran:
                                    <span class="badge bg-warning">
                                        {{ $booking->ms_payment->name }}
                                    </span>
                                </h4> -->
                                <p class="status-draf">Status Pembayaran : {{ $booking->ms_payment->name }}</p>
                            @elseif ($booking->ms_payment->id == 2)
                                <!-- <h4 class="mb-4">Status Pembayaran:
                                    <span class="badge bg-success">
                                        {{ $booking->ms_payment->name }}
                                    </span>
                                </h4> -->
                                <p class="status-belumBayar">Status Pembayaran : {{ $booking->ms_payment->name }}</p>
                            @elseif ($booking->ms_payment->id == 3)
                                <!-- <h4 class="mb-4">Status Pembayaran: 
                                    <span class="badge bg-info">
                                        {{ $booking->ms_payment->name }}
                                    </span>
                                </h4> -->
                                <p class="status-sudahBayar">Status Pembayaran : {{ $booking->ms_payment->name }}</p>
                            @elseif ($booking->ms_payment->id == 4)
                                <!-- <h4 class="mb-4">Status Pembayaran: 
                                    <span class="badge bg-primary">
                                    {{ $booking->ms_payment->name }}
                                    </span>
                                </h4> -->
                                <p class="status-selesai">Status Pembayaran : {{ $booking->ms_payment->name }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        @if ($booking->incomes->isNotEmpty())
                            <div class="row">
                                @if ($booking->incomes->isNotEmpty())
                                    {{-- Loop untuk DP (id_m_income == 1) --}}
                                    @php $dpCount = 1; @endphp
                                    @foreach ($booking->incomes->where('id_m_income', 1) as $income)
                                        <div class="col-lg-6 col-md-12 mb-4 riwayat-content">
                                            <div class="content h-100">
                                                <div class="header text-center d-flex flex-column justify-content-center align-items-center">
                                                    <p class="bayar-title">DP ke-{{ $dpCount }}</p>
                                                    <h5>Rp {{ number_format($income->nominal, 0, ',', '.') }}</h5>
                                                    <!-- <p class="status">Status: {{ $income->ms_income->name }}</p> -->
                                                    <p class="
                                                        @if ($booking->ms_payment->id == 1) 
                                                            draf
                                                        @elseif ($booking->ms_payment->id == 2)
                                                            belumBayar
                                                        @elseif ($booking->ms_payment->id == 3)
                                                            sudahBayar
                                                        @elseif ($booking->ms_payment->id == 4)
                                                            lunas @endif">
                                                        Status : {{ $booking->ms_payment->name }}
                                                    </p>
                                                    <img src="{{ asset('storage/' . $income->image_receipt) }}" alt="Bukti Pembayaran" class="img-fluid" style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                        @php $dpCount++; @endphp

                                        @if ($loop->iteration % 3 == 0 && !$loop->last)
                            </div>
                            <div class="row"> <!-- Membuka row baru setiap 3 elemen -->
                        @endif
                        @endforeach

                        {{-- Loop untuk Pelunasan (id_m_income == 2) --}}
                        @php $pelunasanCount = 1; @endphp
                        @foreach ($booking->incomes->where('id_m_income', 2) as $income)
                            <div class="col-lg-6 col-md-12 mb-4 riwayat-content">
                                <div class="content h-100">
                                    <div
                                        class="header text-center d-flex flex-column justify-content-center align-items-center">
                                        <p class="bayar-title">Pelunasan ke-{{ $pelunasanCount }}</p>
                                        <h5>Rp {{ number_format($income->nominal, 0, ',', '.') }}</h5>
                                        <!-- <p class="status">Status: {{ $income->ms_income->name }}</p> -->
                                        <p class="
                                            @if ($booking->ms_payment->id == 1) 
                                                draf
                                            @elseif ($booking->ms_payment->id == 2)
                                                belumBayar
                                            @elseif ($booking->ms_payment->id == 3)
                                                sudahBayar
                                            @elseif ($booking->ms_payment->id == 4)
                                                lunas @endif">
                                            Status : {{ $booking->ms_payment->name }}
                                        </p>
                                        <img src="{{ asset('storage/' . $income->image_receipt) }}" alt="Bukti Pembayaran"
                                            class="img-fluid" style="width: 100%;">
                                    </div>
                                </div>
                            </div>
                            @php $pelunasanCount++; @endphp

                            @if ($loop->iteration % 3 == 0 && !$loop->last)
                    </div>
                    <div class="row"> <!-- Membuka row baru setiap 3 elemen -->
                        @endif
                        @endforeach
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </section>

    <x-footer-customer />
@endsection

<!-- @section('styles')
    <style>
        .fa-chevron-down {
            font-size: 16px;
            color: #000;
        }

        .rating-stars {
            cursor: pointer;
        }

        .rating-stars .star {
            font-size: 24px;
            color: #ccc;
            transition: color 0.2s;
        }

        .rating-stars .star.selected i {
            color: gold !important;
        }
    </style>
@endsection -->
