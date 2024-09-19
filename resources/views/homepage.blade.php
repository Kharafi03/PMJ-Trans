@extends('frontend.layouts.app')
@push('styles')
    <title>PMJ Trans</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <section class="bg-image" style="background-image: url('img/bg1.png');">
        <header class="py-3 align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col d-none d-md-block">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <a href="#" class="navbar-brand">
                                    <img src="img/logo.png" alt="Logo">
                                    <span class="logo-name ml-2" style="color: white;">PMJ Trans</span>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Bus</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Pusat Bantuan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('booking-status') }}">Cek Pesanan</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Nida Aulia Karima
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('customer-profile') }}">Profil</a></li>
                                    <li><a class="dropdown-item" href="{{('order-history')}}">Riwayat Sewa</a></li>
                                    <li><a class="dropdown-item" href="#">Keluar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="header-text container" style="padding-top: 100px">
            <h1 class="header-title display-4 fw-bold">Menghubungkan Anda ke Seluruh<br><span>Destinasi.</span></h1>
            <button class="btn-pesan"><a
                    href="{{ route('booking') }} "style="text-decoration: none; color:white;">Pesan</a></button>
        </div>
    </section>


    <!-- PACKAGE -->
    <section class="py-5" id="bus">
        <div class="package-container container">
            <h2 style="color: white; font-size: 36px; font-weight: bold;">Daftar Bus PMJ</h2>
            <div class="row mt-4">
                <div id="carouselExampleIndicators" class="carousel slide carousel-dark mb-5">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card-wrapper">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4"> <!-- awal per card carousel-->
                                            <div class="package-card card h-100">
                                                <img src="img/image-bus1.png" alt="Ushuala">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="package-card-title">PMJ Suites</p>
                                                        </div>
                                                        <div class="package-icon col-md-4">
                                                            <i class="fa-solid fa-star"></i> 4.9
                                                        </div>
                                                        <div class="small">
                                                            <p>Lorem ipsum dolor sit amet consectetur elit.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-chair"></i>
                                                            <p>30 Kursi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-tv"></i>
                                                            <p>TV Pribadi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-wifi"></i>
                                                            <p>Free Wifi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-bolt"></i>
                                                            <p>Charger</p>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li>Tempat duduk yang bisa direbahkan 180 derajat untuk kenyamanan
                                                            maksimal.</li>
                                                        <li>Privasi ekstra dengan pembatas dan fasilitas hiburan pribadi.
                                                        </li>
                                                        <li>Dilengkapi dengan Wi-Fi gratis dan colokan listrik/USB.</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn-lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="package-card card h-100">
                                                <img src="img/image-bus1.png" alt="Ushuala">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="package-card-title">PMJ Eksekutif</p>
                                                        </div>
                                                        <div class="package-icon col-md-4">
                                                            <i class="fa-solid fa-star"></i> 4.8
                                                        </div>
                                                        <div class="small">
                                                            <p>Lorem ipsum dolor sit amet consectetur elit.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-chair"></i>
                                                            <p>30 Kursi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-tv"></i>
                                                            <p>TV Pribadi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-wifi"></i>
                                                            <p>Free Wifi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-bolt"></i>
                                                            <p>Charger</p>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li>Tempat duduk ergonomis yang bisa direbahkan.</li>
                                                        <li>Dilengkapi dengan Wi-Fi gratis dan colokan listrik/USB.</li>
                                                        <li>Layar hiburan bersama.</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer align-items-end">
                                                    <button class="btn-lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="package-card card h-100">
                                                <img src="img/image-bus1.png" alt="Ushuala">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="package-card-title">PMJ Ekonomi</p>
                                                        </div>
                                                        <div class="package-icon col-md-4">
                                                            <i class="fa-solid fa-star"></i> 4.7
                                                        </div>
                                                        <div class="small">
                                                            <p>Lorem ipsum dolor sit amet consectetur elit.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-chair"></i>
                                                            <p>30 Kursi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-tv"></i>
                                                            <p>TV Pribadi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-wifi"></i>
                                                            <p>Free Wifi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-bolt"></i>
                                                            <p>Charger</p>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li>Pilihan perjalanan hemat dengan fasilitas dasar yang memadai.
                                                        </li>
                                                        <li>Menyediakan kursi standar yang nyaman untuk perjalanan jarak
                                                            dekat maupun jauh.</li>
                                                        <li>Dilengkapi dengan ventilasi alami dan ruang bagasi yang luas.
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn-lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card-wrapper">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4"> <!-- awal per card carousel-->
                                            <div class="package-card card h-100">
                                                <img src="img/image-bus1.png" alt="Ushuala">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="package-card-title">PMJ Suites</p>
                                                        </div>
                                                        <div class="package-icon col-md-4">
                                                            <i class="fa-solid fa-star"></i> 4.9
                                                        </div>
                                                        <div class="small">
                                                            <p>Lorem ipsum dolor sit amet consectetur elit.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-chair"></i>
                                                            <p>30 Kursi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-tv"></i>
                                                            <p>TV Pribadi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-wifi"></i>
                                                            <p>Free Wifi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-bolt"></i>
                                                            <p>Charger</p>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li>Tempat duduk yang bisa direbahkan 180 derajat untuk kenyamanan
                                                            maksimal.</li>
                                                        <li>Privasi ekstra dengan pembatas dan fasilitas hiburan pribadi.
                                                        </li>
                                                        <li>Dilengkapi dengan Wi-Fi gratis dan colokan listrik/USB.</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn-lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="package-card card h-100">
                                                <img src="img/image-bus1.png" alt="Ushuala">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="package-card-title">PMJ Eksekutif</p>
                                                        </div>
                                                        <div class="package-icon col-md-4">
                                                            <i class="fa-solid fa-star"></i> 4.8
                                                        </div>
                                                        <div class="small">
                                                            <p>Lorem ipsum dolor sit amet consectetur elit.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-chair"></i>
                                                            <p>30 Kursi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-tv"></i>
                                                            <p>TV Pribadi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-wifi"></i>
                                                            <p>Free Wifi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-bolt"></i>
                                                            <p>Charger</p>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li>Tempat duduk ergonomis yang bisa direbahkan.</li>
                                                        <li>Dilengkapi dengan Wi-Fi gratis dan colokan listrik/USB.</li>
                                                        <li>Layar hiburan bersama.</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer align-items-end">
                                                    <button class="btn-lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="package-card card h-100">
                                                <img src="img/image-bus1.png" alt="Ushuala">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="package-card-title">PMJ Ekonomi</p>
                                                        </div>
                                                        <div class="package-icon col-md-4">
                                                            <i class="fa-solid fa-star"></i> 4.7
                                                        </div>
                                                        <div class="small">
                                                            <p>Lorem ipsum dolor sit amet consectetur elit.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-chair"></i>
                                                            <p>30 Kursi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-tv"></i>
                                                            <p>TV Pribadi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-wifi"></i>
                                                            <p>Free Wifi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-bolt"></i>
                                                            <p>Charger</p>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li>Pilihan perjalanan hemat dengan fasilitas dasar yang memadai.
                                                        </li>
                                                        <li>Menyediakan kursi standar yang nyaman untuk perjalanan jarak
                                                            dekat maupun jauh.</li>
                                                        <li>Dilengkapi dengan ventilasi alami dan ruang bagasi yang luas.
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn-lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card-wrapper">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4"> <!-- awal per card carousel-->
                                            <div class="package-card card h-100">
                                                <img src="img/image-bus1.png" alt="Ushuala">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="package-card-title">PMJ Suites</p>
                                                        </div>
                                                        <div class="package-icon col-md-4">
                                                            <i class="fa-solid fa-star"></i> 4.9
                                                        </div>
                                                        <div class="small">
                                                            <p>Lorem ipsum dolor sit amet consectetur elit.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-chair"></i>
                                                            <p>30 Kursi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-tv"></i>
                                                            <p>TV Pribadi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-wifi"></i>
                                                            <p>Free Wifi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-bolt"></i>
                                                            <p>Charger</p>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li>Tempat duduk yang bisa direbahkan 180 derajat untuk kenyamanan
                                                            maksimal.</li>
                                                        <li>Privasi ekstra dengan pembatas dan fasilitas hiburan pribadi.
                                                        </li>
                                                        <li>Dilengkapi dengan Wi-Fi gratis dan colokan listrik/USB.</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn-lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="package-card card h-100">
                                                <img src="img/image-bus1.png" alt="Ushuala">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="package-card-title">PMJ Eksekutif</p>
                                                        </div>
                                                        <div class="package-icon col-md-4">
                                                            <i class="fa-solid fa-star"></i> 4.8
                                                        </div>
                                                        <div class="small">
                                                            <p>Lorem ipsum dolor sit amet consectetur elit.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-chair"></i>
                                                            <p>30 Kursi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-tv"></i>
                                                            <p>TV Pribadi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-wifi"></i>
                                                            <p>Free Wifi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-bolt"></i>
                                                            <p>Charger</p>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li>Tempat duduk ergonomis yang bisa direbahkan.</li>
                                                        <li>Dilengkapi dengan Wi-Fi gratis dan colokan listrik/USB.</li>
                                                        <li>Layar hiburan bersama.</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer align-items-end">
                                                    <button class="btn-lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="package-card card h-100">
                                                <img src="img/image-bus1.png" alt="Ushuala">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="package-card-title">PMJ Ekonomi</p>
                                                        </div>
                                                        <div class="package-icon col-md-4">
                                                            <i class="fa-solid fa-star"></i> 4.7
                                                        </div>
                                                        <div class="small">
                                                            <p>Lorem ipsum dolor sit amet consectetur elit.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-chair"></i>
                                                            <p>30 Kursi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-tv"></i>
                                                            <p>TV Pribadi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-wifi"></i>
                                                            <p>Free Wifi</p>
                                                        </div>
                                                        <div class="fasilitas-package col-md-3 text-center">
                                                            <i class="fa-solid fa-bolt"></i>
                                                            <p>Charger</p>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li>Pilihan perjalanan hemat dengan fasilitas dasar yang memadai.
                                                        </li>
                                                        <li>Menyediakan kursi standar yang nyaman untuk perjalanan jarak
                                                            dekat maupun jauh.</li>
                                                        <li>Dilengkapi dengan ventilasi alami dan ruang bagasi yang luas.
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn-lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Navigation Buttons -->
                    <button class="package-button carousel-control-prev" type="button"
                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span aria-hidden="true"><i class="fa-solid fa-chevron-left"></i></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="package-button carousel-control-next" type="button"
                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- CARA PENYEWAAN -->
    <section id="cara">
        <div class="container mt-3">
            <div class="row align-items-center">
                <div class="col-md-6 text-travel-point a">
                    <div class="text-container">
                        <p style="font-size: 44px;"><b>Cara Penyewaan</b></p>
                        <p style="color: #6666667D; font-size: 16px; font-weight: bold;">Ikuti langkah dibawah ini untuk
                            melakukan penyewaan BUS di PMJ Trans</p>
                    </div>
                    <div class="cara-item">
                        <div class="row" style="margin-bottom: 45px;">
                            <div class="col-md-3">
                                <div class="cara-icon">1</div>
                            </div>
                            <div class="col-md-9">
                                <p><b>Pilih Bus</b></p>
                                <p style="color: #5E6282; margin-top: -15px;">Pilih bus yang tersedia dari layanan PMJ
                                    Trans.</p>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-3">
                                <div class="cara-icon">2</div>
                            </div>
                            <div class="col-md-9">
                                <p><b>Pemesanan Bus (2 cara)</b></p>
                                <p style="color: #5E6282; margin-top: -15px;">Hubungi admin melalui kontak yang tersedia
                                    pada website untuk memesan bus, atau isi formulir pemesanan melalui tombol "Pesan" yang
                                    terdapat pada halaman utama.</p>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-3">
                                <div class="cara-icon">3</div>
                            </div>
                            <div class="col-md-9">
                                <p><b>Menunggu Konfiramasi Admin</b></p>
                                <p style="color: #5E6282; margin-top: -15px;">Admin akan mengirimkan konfirmasi melalui
                                    WhatsApp. Jika Anda melakukan pemesanan melalui website, harap periksa status pesanan
                                    Anda secara berkala untuk melihat konfirmasi pemesanan.</p>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-3">
                                <div class="cara-icon">4</div>
                            </div>
                            <div class="col-md-9">
                                <p><b>Pembayaran</b></p>
                                <p style="color: #5E6282; margin-top: -15px;">Lakukan pembayaran di PMJ Trans dengan
                                    mengirimkan uang muka (DP) terlebih dahulu. Sisa pembayaran dapat dilakukan saat trip
                                    atau di lokasi penjemputan bus.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="img/rent-image.png" alt="gambar" width="500px" height="600px"
                        style="margin-left: 100px;">
                </div>

            </div>
        </div>
    </section>



    <!-- WHY -->
    <section id="why-cont">
        <div class="container">
            <div class="text-container">
                <!-- <p style="color: #F411CF;margin-bottom: 5px;">S E R V I C E S</p> -->
                <p style="font-size: 44px;"><b>Kenapa Harus Sewa di PMJ?</b></p><br><br>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col ">
                    <div class="why-card card h-100 text-center d-flex justify-content-center align-items-center">
                        <img src="img/why-image1.png" width="60px" height="60px" alt="images1">
                        <div class="card-body">
                            <h5 class="card-title">Banyak Pilihan</h5>
                            <p class="card-text">Kami menyedikan banyak pilihan destinasi dan BUS yang dapat anda pilih,
                                sesuai kebutuhan dan keinganan.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="why-card card h-100 text-center d-flex justify-content-center align-items-center">
                        <img src="img/why-image2.png" width="60px" height="60px" alt="images2">
                        <div class="card-body">
                            <h5 class="card-title">Penyewaan Mudah</h5>
                            <p class="card-text">PMJ Trans menyediakan penyewaan yang mudah dengan cara mengisi formulir
                                dan kontak admin</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="why-card card h-100 text-center d-flex justify-content-center align-items-center">
                        <img src="img/why-image3.png" width="60px" height="60px" alt="images3">
                        <div class="card-body">
                            <h5 class="card-title">Harga Bersahabat</h5>
                            <p class="card-text">Kami menyediakan tarif yang terjangkau dengan kendaraan modern, memastikan
                                perjalanan Anda nyaman dan terpercaya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- TENTANG KAMI -->
    <section id="about">
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img class="img img-fluid" src="img/about-imgage.png" alt="gambar" width="500px" height="600px">
                </div>
                <div class="col-md-6 text-travel-point a">
                    <div class="text-container">
                        <!-- <p style="color: #F411CF;margin-bottom: 5px;">T R A V E L &nbsp; P O I N T</p> -->
                        <p style="font-size: 44px;"><b>Tentang Kami</b></p>
                        <p style="color: #A8A8A8; font-size: 18px;">PMJ Trans adalah layanan penyewaan bus pariwisata di
                            Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas
                            untuk perjalanan yang nyaman dan aman,
                            dengan fokus pada kepuasan pelanggan..</p>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-4" style="margin-right: 200px;">
                        <div class="col">
                            <div class="about-card card text-center ">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #1E9781;">30+</h5>
                                    <p class="card-text">Bus</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="about-card card text-center ">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #1E9781;">450+</h5>
                                    <p class="card-text">Jam Perjalanan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="about-card card text-center ">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #1E9781;">50+</h5>
                                    <p class="card-text">Destinasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="about-card card text-center ">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #1E9781;">12k+</h5>
                                    <p class="card-text">Pelanggan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- TESTIMONI -->
    <section id="testimoni">
        <div class="testi">
            <div class="text-container">
                <p style="color: #1E9781;margin-bottom: 5px;">T E S T I M O N I</p>
                <p style="font-size: 44px;"><b>Kata Mereka</b></p>
            </div>
            <div id="carouselExampleIndicators2" class="carousel slide">
                <div class="carousel-indicators" style="margin-top: 50px;">
                    <br>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"
                        style="width: 15px; height: 15px; border-radius: 50%; background-color: #4ABDAC;"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"
                        style="width: 15px; height: 15px; border-radius: 50%; background-color: #4ABDAC;"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"
                        style="width: 15px; height: 15px; border-radius: 50%; background-color: #4ABDAC;"></button>
                </div>
                <div class="testimoni-carousel-inner carousel-inner">
                    <div class="carousel-item active align-items-center">
                        <!-- <img src="..." class="d-block w-100" alt="..."> -->
                        <img src="img/avatar.png" class="testi-img"alt="Customer">
                        <h5><b>Nida Aulia Karima</b></h5>
                        <p>Customer</p>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p>Saya suka PMJ Trans, ini adalah tempat terbaik untuk membeli tiket dan membantu Anda menemukan
                            liburan impian Anda.</p>
                    </div>
                    <div class="carousel-item active align-items-center">
                        <!-- <img src="..." class="d-block w-100" alt="..."> -->
                        <img src="img/avatar.png" class="testi-img" alt="Customer">
                        <h5><b>Nida Aulia Karima</b></h5>
                        <p>Customer</p>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p>Saya suka PMJ Trans, ini adalah tempat terbaik untuk membeli tiket dan membantu Anda menemukan
                            liburan impian Anda.</p>
                    </div>
                    <div class="carousel-item active align-items-center">
                        <!-- <img src="..." class="d-block w-100" alt="..."> -->
                        <img src="img/avatar.png" class="testi-img" alt="Customer">
                        <h5><b>Nida Aulia Karima</b></h5>
                        <p>Customer</p>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p>Saya suka PMJ Trans, ini adalah tempat terbaik untuk membeli tiket dan membantu Anda menemukan
                            liburan impian Anda.</p>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators2"
                    data-bs-slide="prev">
                    <span aria-hidden="true"><span aria-hidden="true"><i
                                class="fa-solid fa-chevron-left"></i></span></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators2"
                    data-bs-slide="next">
                    <span aria-hidden="true"><span aria-hidden="true"><i
                                class="fa-solid fa-chevron-right"></i></span></span>
                </button>
            </div>
        </div>
    </section>




    <!-- FOOTER -->
    <footer class="py-3">
        <div class="container" style="padding: 50px 0px;">
            <div class="row">
                <div class="col-md-4" style="padding-right: 80px;">
                    <img src="img/logo.png" alt="Travelo Logo" height="30">
                    <span style="color: white;font-size: 24px; font-weight: bold;">PMJ Trans</span>
                    <p style="font-size: 18px;text-align: justify; margin-top: 50px;">PMJ Trans adalah layanan penyewaan
                        bus pariwisata di Jl. Lingkar Timur Ngembel, Kudus. Kami menyediakan armada berkualitas untuk
                        perjalanan yang nyaman dan aman, dengan fokus pada kepuasan pelanggan.</p>
                </div>
                <div class="col-md-4">
                    <h6>Hubungi Kami</h6>
                    <ul class="list-unstyled">
                        <li>
                        <li><a href="#" style="text-decoration: none;">Jl. Lingkar Timur Ngembel, Kudus.</a></li>
                        </li>
                        <li>
                        <li><a href="#" style="text-decoration: none;">pmjtrans@gmail.com</a></li>
                        </li>
                        <li>
                        <li><a href="#" style="text-decoration: none;">0856-9877-5655</a></li>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Link Cepat</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" style="text-decoration: none;">Beranda</a></li>
                        <li><a href="#package" style="text-decoration: none;">Bus</a></li>
                        <li><a href="#about" style="text-decoration: none;">Tentang Kami</a></li>
                        <li><a href="#" style="text-decoration: none;">Pusat Bantuan</a></li>
                        <li><a href="#" style="text-decoration: none;">Cek Pesanan</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Sosial Media</h6>
                    <a href="#" class="text-light"><i class="fab fa-instagram"></i></i></a>
                    <a href="#" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light mx-2"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright container">
        <p class="text-center m-0" style="color:#00000094;">&copy;2024 PMJ Trans. All Rights Reserved</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>


    <!-- SCRIPT -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('header');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) { // Atur nilai ini sesuai kebutuhan Anda
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            });
        });

        // JavaScript to add/remove the header-scrolled class based on scroll position
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        });
    </script>
@endsection
