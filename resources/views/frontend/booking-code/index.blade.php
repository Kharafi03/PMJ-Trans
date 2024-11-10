@extends('frontend.layouts.app')
@push('styles')
    <title>E-Ticket</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/tiket-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />
    <!-- Bread Crumbs -->
    <nav aria-label="breadcrumb" style="margin-top: 100px;" class="wow animate__animated animate__fadeIn" data-wow-delay="0.6s">
        <ol class="breadcrumb d-flex justify-content-center align-items-center">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('booking.store')}}">Formulir Pemesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">E-Ticket</li>
        </ol>
    </nav>

    @if($showPasswordModal)
        <!-- MODAL -->
        <div class="modal fade" id="modalTiket" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: none !important; border: none;padding-top: 15px;"><img src="{{ asset('img/close.png') }}"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center mb-3">
                            <img class="img-fluid" src="{{ asset(('img/update-pw-img.png')) }}">
                        </div>
                        <div class="info mt-3">
                            <p class="info-title"><i class="fa-solid fa-circle-exclamation"></i> Informasi Ubah Kata Sandi</p>
                            <ul>
                                <li>Segera ganti kata sandi Anda karena saat ini menggunakan kata sandi sementara: '12345678'. Pilih kata sandi yang mudah diingat dan, jika perlu, catat agar tidak lupa. Gunakan kombinasi huruf, angka, dan simbol, misalnya: <span style="font-weight: 700; color: #4180CC; font-weight: 700;">Contohpassword13!</span></li>
                            </ul>
                        </div>
                        <form action="{{ route('booking-code.updatePassword') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="mb-4">
                                <label for="new_password" class="form-label ">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Masukan Password Baru" required autocomplete="new-password">
                                    <span class="input-group-text" id="pw-icon" onclick="togglePassword(this)" style="cursor: pointer;">
                                        <i class="fas fa-eye-slash" style="font-size: 1rem"></i>
                                    </span>
                                    @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="konfirmasi_password"class="form-label ">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control @error('konfirmasi_password') is-invalid @enderror" placeholder="Konfirmasi Password" required autocomplete="new-password">
                                    <span class="input-group-text" id="pw-icon" onclick="togglePassword(this)" style="cursor: pointer;">
                                        <i class="fas fa-eye-slash" style="font-size: 1rem"></i>
                                    </span>
                                    @error('konfirmasi_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-5">
                                <button type="submit" class="btn-password">Perbarui Password</button>
                            </div>                                
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- CONTENT -->
    <section id="tiket" class="py-5 mt-5">
        <div class="container">
        
            <!-- MODAL -->
            @if($showPasswordModal)
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0.7s" role="alert" style="padding: 1.25rem; border-radius: 0.5rem;">
                    <div style="flex-grow: 1;">
                        <strong>Perhatian!</strong> Anda masih menggunakan kata sandi sementara '12345678'. Demi keamanan, segera perbarui kata sandi akun Anda!
                    </div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-warning me-5" style="font-weight: bold; color: #fff;">
                        Ubah Password
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('passwordUpdated'))
                <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show d-flex align-items-center  wow animate__animated animate__fadeInUp" data-wow-delay="0.7s" role="alert" style="padding: 1.25rem; border-radius: 0.5rem;">
                    <div style="flex-grow: 1;">
                        <strong>{{ session('alert-type') == 'success' ? 'Berhasil!' : 'Gagal!' }}</strong> {{ session('message') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="text-content wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-xl-6 text-content">
                        <h1 class="mb-3">E-Ticket <span>{{ $setting ? $setting->name : '#' }} </span></h1>
                    </div>
                    <div class="col-xl-6 btn-content">
                        <button id="download" class="btn-download">Download PDF</button>
                    </div>
                    <p style="font-size: 16px; font-weight: 400; color: #000000AD;">Berikut Kode Booking yang dapat anda gunakan untuk penyewaan BUS di PMJ Trans</p>
                </div>
            </div>
            @include('frontend.assets.alert')
            <div class="tiket-container wow animate__animated animate__fadeInUp" data-wow-delay="0.7s" style="width: 100% !important">
                <div class="row">
                    <!-- Kolom 1 -->
                    <div class="col-xl-5">
                        <div class="ticketContainer">
                            <div class="tiket-ruler"></div>
                            <div class="ticket">
                                <div class="ticketTitle mb-2">
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <img src="{{ asset('img/logo.png') }}" alt="icon" width="50px" height="40px">
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
                                                <div class="col-2 d-flex justify-content-center">
                                                    <img src="{{ asset('img/Ellipse 43.png') }}" alt="Profile Image">
                                                </div>
                                                <div class="col-10 d-flex align-items-center">
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
                        <div class="text-container mt-3">
                            <div class="text-content">
                                <h1 class="mb-3" style="font-size: 30px;">Petunjuk <span>E-Ticket</span></h1>
                                <p style="color: #000000AD;" >Berikut Detail Pembayaran selama menyewa bus PMJ Trans.</p>
                            </div>
                            <div class="row warning mb-3 align-items-center">
                                <div class="col-4 col-lg-2 col-md-3 d-flex justify-content-center align-items-center icon-warning">
                                    <i class="fa-solid fa-ticket-simple"></i>  
                                </div>
                                <div class="col-8 col-lg-10 col-md-9 d-flex align-items-center">
                                    <p class="mb-0">
                                        Periksa status pemesanan Anda melalui menu <span>Cek Pemesanan</span> di bagian atas halaman atau klik tautan <a href="{{ route('cek.status') }}"><i class="fa-solid fa-link"></i> cek pemesanan</a> ini untuk melihat perkembangan status booking Anda.
                                    </p>
                                </div>
                            </div>
                            <div class="row warning mb-3 align-items-center">
                                <div class="col-4 col-lg-2 col-md-3 d-flex justify-content-center align-items-center icon-warning">
                                    <i class="fa-solid fa-clipboard-check"></i>
                                </div>
                                <div class="col-8 col-lg-10 col-md-9 d-flex align-items-center">
                                    <p class="mb-0">Tunjukan E-Tiket dan identitas penumpang saat pengambilan bus.</p>
                                </div>
                            </div>
                            <div class="row warning mb-3">
                                <div class="col-4 col-lg-2 col-md-3 d-flex justify-content-center align-items-center icon-warning">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <div class="col-8 col-lg-10 col-md-9 d-flex align-items-center">
                                    <p class="mb-0">Harap datang tepat waktu, keterlambatan maksimal 40 menit sebelum
                                        keberangkatan.</p>
                                </div>
                            </div>
                            <div class="row warning mb-3">
                                <div class="col-4 col-lg-2 col-md-3 d-flex justify-content-center align-items-center icon-warning">
                                    <i class="fa-solid fa-triangle-exclamation" style="padding-bottom: 7px;"></i>
                                </div>
                                <div class="col-8 col-lg-10 col-md-9 d-flex align-items-center">
                                    <p class="mb-0">Dilarang membawa senjata atau hal lain yang membahayakan.</p>
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

        //modal
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modalTiket'));
            myModal.show();
        });

        //toggle password
        function togglePassword(element) {
            const $input = $(element).closest('.input-group').find('input');
            const $icon = $(element).find('i');

            if ($input.attr('type') === 'password') {
                $input.attr('type', 'text');
                $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                $input.attr('type', 'password');
                $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        }
    </script>    
    <script>
        new WOW().init();
    </script>
@endpush
