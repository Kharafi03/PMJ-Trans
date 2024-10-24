@extends('frontend.layouts.app')
@push('styles')
    <title>E-Ticket</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/tiket-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />
    <!-- Bread Crumbs -->
    <nav aria-label="breadcrumb" style="margin-top: 100px;">
        <ol class="breadcrumb d-flex justify-content-center align-items-center">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('booking.store')}}">Formulir Pemesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">E-Tiket</li>
        </ol>
    </nav>

    <!-- CONTENT -->
    <section id="tiket" class="py-5 mt-5">
        <div class="container">
            <div class="text-content mb-5">
                <div class="row">
                    <div class="col-xl-6">
                        <h5 style="font-size: 44px; font-weight: 700; color: #1E9781;">E-Ticket</h5>
                        <p style="font-size: 16px; font-weight: 500; color: #6F6C90;">Berikut Detail Pembayaran selama
                            menyewa bus
                            PMJ Trans.</p>
                    </div>
                    <div class="col-xl-6 d-flex justify-content-end align-items-center">
                        <button id="download" class="btn btn-download">Download PDF</button>
                    </div>
                </div>
            </div>
            @include('frontend.assets.alert')
            <div class="tiket-container" style="width: 100% !important">
                <div class="row">
                    <!-- Kolom 1 -->
                    <div class="col-xl-5">
                        <div class="ticketContainer">
                            <div class="tiket-ruler"></div>
                            <div class="ticket">
                                <div class="ticketTitle mb-2">
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <img src="{{ asset('img/logo.png') }}" alt="icon" width="50px"
                                                height="40px">
                                        </div>
                                        <div class="col-9">
                                            <p class="text-end" style="padding-top: 5px;">
                                                {{ \Carbon\Carbon::parse($booking->date_start)->translatedFormat('l, d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tiket-card mb-3">
                                        <div class="profile-card p-3">
                                            <div class="row">
                                                <div class="col-3 d-flex justify-content-center">
                                                    <img src="{{ asset('img/Ellipse 43.png') }}" alt="Profile Image">
                                                </div>
                                                <div class="col-9 d-flex align-items-center">
                                                    <div class="profile-text">
                                                        <h5>{{ $booking->customer->name }}</h5>
                                                        <p>Jumlah Penumpang : {{ $booking->capacity }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-tiket mt-3">
                                            <div class="row text-center align-items-stretch">
                                                <div class="col-6 d-flex flex-column justify-content-center" style="border-right: 3px solid #C9C9C93D;">
                                                    <h5 class="mt-auto mb-3">Kode Booking</h5>
                                                    <p class="mt-auto">{{ $booking->booking_code }}</p>
                                                </div>
                                                <div class="col-6 d-flex flex-column justify-content-center">
                                                    <h5 class="mt-auto mb-3">Nomor WhatsApp</h5>
                                                    <p class="mt-auto">{{ $booking->customer->number_phone }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ticketRip d-flex justify-content-between">
                                    <div class="circleLeft"></div>
                                    <div class="ripLine"></div>
                                    <div class="circleRight"></div>
                                </div>
                                <div class="tujuan-tiket">
                                    <div class="tujuan-container">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <h5 style="padding-top: 5px;">Titik Jemput</h5>
                                            </div>
                                            <div class="col-6">
                                                <h5 style="padding-top: 5px;">Tujuan</h5>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <p>{{ $booking->pickup_point }}</p>
                                            </div>
                                            <div class="col-6">

                                                @foreach ($destinations as $dest)
                                                    @if ($loop->count > 1)
                                                        <p class="m-0">{{ $loop->iteration }}. {{ $dest->name }}</p>
                                                    @else
                                                        <p>{{ $dest->name }}</p>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kolom 2 -->
                    <div class="col-xl-7">
                        <div class="text-container mt-5">
                            <div class="text-content mb-5">
                                <h5 style="font-size: 30px; font-weight: 700; color: #1E9781;">Petunjuk <span
                                        style="color: #FD9C07;">E-Ticket</span></h5>
                                <p style="font-size: 16px; font-weight: 500; color: #6F6C90;">Berikut Detail Pembayaran
                                    selama menyewa bus PMJ Trans.</p>
                            </div>
                            <div class="row warning mb-3 align-items-center">
                                <div class="col-4 col-lg-2 col-md-3 d-flex justify-content-center">
                                    <span class="icon-warning" style="display: inline-block; vertical-align: middle;">
                                        <img src="{{ asset('img/ticket.png') }}">
                                    </span>
                                </div>
                                <div class="col-8 col-lg-10 col-md-9 d-flex align-items-center">
                                    <p class="mb-0">Tunjukan E-Tiket dan identitas penumpang saat pengambilan bus.</p>
                                </div>
                            </div>

                            <div class="row warning mb-3">
                                <div class="col-4 col-lg-2 col-md-3 d-flex justify-content-center">
                                    <span class="icon-warning" style="display: inline-block; vertical-align: middle;">
                                        <img src="{{ asset('img/clock.png') }}">
                                    </span>
                                </div>
                                <div class="col-8 col-lg-10 col-md-9 d-flex align-items-center">
                                    <p class="mb-0">Harap datang tepat waktu, keterlambatan maksimal 40 menit sebelum
                                        keberangkatan.</p>
                                </div>
                            </div>
                            <div class="row warning mb-3">
                                <div class="col-4 col-lg-2 col-md-3 d-flex justify-content-center">
                                    <span class="icon-warning" style="display: inline-block; vertical-align: middle;">
                                        <img src="{{ asset('img/warning.png') }}">
                                    </span>
                                </div>
                                <div class="col-8 col-lg-10 col-md-9 d-flex align-items-center">
                                    <p class="mb-0">Dilarang membawa senjata atau hal lain yang
                                        membahayakan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />
@endsection

@push('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script> --}}
    <script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>
        document.getElementById('download').addEventListener('click', function() {
            // Element yang ingin diubah menjadi PDF
            const element = document.querySelector('.tiket-container');

            // Simpan elemen yang perlu disembunyikan
            const nonPrintableElements = document.body.children;

            // Sembunyikan elemen non-printable
            for (let i = 0; i < nonPrintableElements.length; i++) {
                if (nonPrintableElements[i] !== element) {
                    nonPrintableElements[i].style.display = 'none'; // Sembunyikan elemen lainnya
                }
            }

            // Opsi untuk pdf
            const options = {
                margin: 0.1,
                filename: `E-Ticket {{{ $booking->booking_code }}}.pdf`, // Menggunakan nama file dinamis
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3
                },
                jsPDF: {
                    unit: 'in',
                    format: 'b4',
                    orientation: 'portrait'
                }
            };

            // Mengonversi elemen ke PDF
            html2pdf().from(element).set(options).save().then(() => {
                // Kembalikan tampilan ke semula
                for (let i = 0; i < nonPrintableElements.length; i++) {
                    nonPrintableElements[i].style.display = ''; // Kembalikan tampilan elemen lainnya
                }
            });
        });
    </script>
@endpush
