<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking PDF</title>
        <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

        <script src="{{ public_path('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    </script>
    <link id="pagestyle" href="{{ public_path('css/frontend/css/tiket-pdf.css') }}" rel="stylesheet">
</head>

<body>
    <section id="tiket">
        <div class="container mb-5">
            <div class="text-content mb-5">
                <h5 style="font-size: 44px; font-weight: 700; color: #1E9781;">E-Ticket</h5>
                <p style="font-size: 16px; font-weight: 500; color: #6F6C90;">Berikut Detail Pembayaran selama menyewa bus
                    PMJ Trans.</p>
            </div>
            <div class="tiket-container">
                <div class="row">
                    <!-- Kolom 1 -->
                    <div class="col-xl-4">
                        <div class="ticketContainer">
                            <div class="tiket-ruler"></div>
                            <div class="ticket">
                                <div class="ticketTitle mb-2">
                                    {{-- <div class="header-tiket"> --}}
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="{{ asset('img/logo.png') }}" alt="icon" width="50px"
                                                    height="40px">
                                            </div>
                                            <div class="col-9">
                                                <p class="text-end">
                                                    {{ \Carbon\Carbon::parse($booking->date_start)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                    {{-- </div> --}}
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
                                <div class="ticketRip">
                                    <div class="row">
                                        <div class="col-1">
                                            <div class="circleLeft"></div>
                                        </div>
                                        <div class="col-10">
                                            <div class="ripLine"></div>
                                        </div>
                                        <div class="col-1">
                                            <div class="circleRight"></div>
                                        </div>
                                    </div>
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
                    <div class="col-xl-8">
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
                            <a href="{{ route('booking.downloadPdf', $booking->booking_code) }}"
                                class="btn btn-primary mt-5" target="_blank">Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
