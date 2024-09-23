@extends('frontend.layouts.app')
@push('styles')
    <title>PMJ Trans</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/homepage-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- HEADER -->
    <section id="header">
        <div class="bg-image" style="background-image: url('img/bg1.png');">
            <!-- NAVBAR -->
            <x-navbar-customer />
            <div class="header-text container" style="padding-top: 100px">
                <h1 class="header-title display-4 fw-bold">Menghubungkan Anda ke Seluruh<br><span>Destinasi.</span></h1>
                <button class="btn-pesan">Pesan</button>
            </div>
        </div>
    </section>



    <!-- DAFTAR BUS -->
    <section id="package">
        <div class="package-container container">
            <h2>Daftar Bus PMJ</h2>
            <div id="carouselExampleIndicators" class="carousel slide carousel-dark mb-5">
                <div class="carousel-inner">
                    <!-- Carousel Item 1 -->
                    <div class="carousel-item active">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="package-card card h-100">
                                    <img src="img/image-bus1.png" alt="Bus 1" class="img-fluid">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <p class="package-card-title">PMJ Suites</p>
                                            <div class="package-icon">
                                                <i class="fa-solid fa-star"></i> 4.8
                                            </div>
                                        </div>
                                        <p class="small">Lorem ipsum dolor sit amet consectetur elit.</p>
                                        <div class="row mt-3 mb-3 text-center">
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-chair"></i>
                                                <p>30 Kursi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-tv"></i>
                                                <p>TV Pribadi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-wifi"></i>
                                                <p>Free Wifi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-bolt"></i>
                                                <p>Charger</p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li>Tempat duduk yang bisa direbahkan 180 derajat untuk kenyamanan maksimal.
                                            </li>
                                            <li>Privasi ekstra dengan pembatas dan fasilitas hiburan pribadi.</li>
                                            <li>Dilengkapi dengan Wi-Fi gratis dan colokan listrik/USB.</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- Card 2 -->
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="package-card card h-100">
                                    <img src="img/image-bus1.png" alt="Bus 2" class="img-fluid">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <p class="package-card-title">PMJ Eksekutif</p>
                                            <div class="package-icon">
                                                <i class="fa-solid fa-star"></i> 4.8
                                            </div>
                                        </div>
                                        <p class="small">Lorem ipsum dolor sit amet consectetur elit.</p>
                                        <div class="row mt-3 mb-3 text-center">
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-chair"></i>
                                                <p>30 Kursi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-tv"></i>
                                                <p>TV Pribadi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-wifi"></i>
                                                <p>Free Wifi</p>
                                            </div>
                                            <div class="col-3 text-icon">
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

                                </div>
                            </div>
                            <!-- Card 3 -->
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="package-card card h-100">
                                    <img src="img/image-bus1.png" alt="Bus 3" class="img-fluid">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <p class="package-card-title">PMJ Premium</p>
                                            <div class="package-icon">
                                                <i class="fa-solid fa-star"></i> 4.7
                                            </div>
                                        </div>
                                        <p class="small">Lorem ipsum dolor sit amet consectetur elit.</p>
                                        <div class="row mt-3 mb-3 text-center">
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-chair"></i>
                                                <p>30 Kursi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-tv"></i>
                                                <p>TV Pribadi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-wifi"></i>
                                                <p>Free Wifi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-bolt"></i>
                                                <p>Charger</p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li>Tempat duduk yang sangat nyaman dengan fitur tambahan.</li>
                                            <li>Wi-Fi dan colokan listrik untuk setiap kursi.</li>
                                            <li>Hiburan multimedia premium.</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Item 2 -->
                    <div class="carousel-item">
                        <div class="row">
                            <!-- Card 4 -->
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="package-card card h-100">
                                    <img src="img/image-bus1.png" alt="Bus 4" class="img-fluid">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <p class="package-card-title">PMJ Luxury</p>
                                            <div class="package-icon">
                                                <i class="fa-solid fa-star"></i> 4.6
                                            </div>
                                        </div>
                                        <p class="small">Lorem ipsum dolor sit amet consectetur elit.</p>
                                        <div class="row mt-3 mb-3 text-center">
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-chair"></i>
                                                <p>30 Kursi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-tv"></i>
                                                <p>TV Pribadi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-wifi"></i>
                                                <p>Free Wifi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-bolt"></i>
                                                <p>Charger</p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li>Kursi yang sangat nyaman dengan fitur pijat.</li>
                                            <li>Wi-Fi super cepat dan beberapa colokan listrik.</li>
                                            <li>Pengalaman hiburan kelas atas lalala yeyey lulu.</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- Card 5 -->
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="package-card card h-100">
                                    <img src="img/image-bus1.png" alt="Bus 1" class="img-fluid">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <p class="package-card-title">PMJ Suites</p>
                                            <div class="package-icon">
                                                <i class="fa-solid fa-star"></i> 4.9
                                            </div>
                                        </div>
                                        <p class="small">Lorem ipsum dolor sit amet consectetur elit.</p>
                                        <div class="row mt-3 mb-3 text-center">
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-chair"></i>
                                                <p>30 Kursi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-tv"></i>
                                                <p>TV Pribadi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-wifi"></i>
                                                <p>Free Wifi</p>
                                            </div>
                                            <div class="col-3 text-icon">
                                                <i class="fa-solid fa-bolt"></i>
                                                <p>Charger</p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li>Tempat duduk yang bisa direbahkan 180 derajat untuk kenyamanan maksimal.
                                            </li>
                                            <li>Privasi ekstra dengan pembatas dan fasilitas hiburan pribadi.</li>
                                            <li>Dilengkapi dengan Wi-Fi gratis dan colokan listrik/USB.</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Navigation Buttons -->
                <button class="package-button package-control-prev" type="button"
                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span aria-hidden="true"><i class="fa-solid fa-chevron-left"></i></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="package-button package-control-next" type="button"
                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- CARA PENYEWAAN -->
    <section id="caraPenyewaan">
        <div class="container-fluid cara-container">
            <div class="cara-title text-center">
                <h5>Cara Penyewaan</h5>
                <p>Ikuti langkah dibawah ini untuk melakukan penyewaan BUS di PMJ Trans</p>
            </div>
            <div class="row" style="background-image: url('img/bg-cara.png');">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <img src="img/cara1.png" class="img-fluid" alt="cara 1">
                        <h5>Pilih Bus</h5>
                        <p>Pilih bus yang tersedia dari layanan PMJ Trans.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <img src="img/cara2.png" class="img-fluid" alt="cara 1">
                        <h5>Pesan Bus</h5>
                        <p>Melalui Admin Atau Website dengan mengisi formulir pemesanan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <img src="img/cara3.png" class="img-fluid" alt="cara 1">
                        <h5>Konfirmasi Admin</h5>
                        <p>Konfirmasi via WhatsApp jika pemesanan melalui admin atau cek pemesanan jika menggunakan website.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <img src="img/cara4.png" class="img-fluid" alt="cara 1">
                        <h5>Pembayaran</h5>
                        <p>Unggah bukti pembayaran DP, sisa pembayaran dapat dilakukan saat trip atau di Kantor PMJ.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="homepage-content" style="background-image: url('img/bg-body.png');">

        <!-- KENAPA -->
        <section id="why">
            <div class="container">
                <div class="text-container">
                    <p style="font-size: 44px;"><b>Kenapa Harus Sewa di PMJ?</b></p>
                    <p style="font-size: 17px; font-weight: 600; color: #666666B5;">Berikut alasan yang kenapa harus sewa
                        di PMJ</p>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 p-3">
                    <div class="col-md-4 mb-3" id="card1">
                        <div class="why-card card h-100 d-flex justify-content-center align-items-center">
                            <img class="img-fluid mb-4" src="img/why-image1.png" width="60px" height="60px"
                                alt="images1">
                            <div class="card-body">
                                <h5 class="why-title">Banyak Pilihan</h5>
                                <p class="card-text">Kami menyedikan banyak pilihan destinasi dan BUS yang dapat anda
                                    pilih, sesuai kebutuhan dan keinganan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3" id="card2">
                        <div class="why-card card h-100 d-flex justify-content-center align-items-center">
                            <img class="img-fluid mb-4" src="img/why-image2.png" width="60px" height="60px"
                                alt="images2">
                            <div class="card-body">
                                <h5 class="why-title">Penyewaan Mudah</h5>
                                <p class="card-text">PMJ Trans menyediakan penyewaan yang mudah dengan cara mengisi
                                    formulir dan kontak admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3" id="card3">
                        <div class="why-card card h-100 d-flex justify-content-center align-items-center">
                            <img class="img-fluid mb-4" src="img/why-image3.png" width="60px" height="60px"
                                alt="images3">
                            <div class="card-body">
                                <h5 class="why-title">Harga Bersahabat</h5>
                                <p class="card-text">Kami menyediakan tarif yang terjangkau dengan kendaraan modern,
                                    memastikan perjalanan Anda nyaman dan terpercaya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TENTANG KAMI -->
        <section id="about" class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0 d-flex justify-content-center">
                        <img class="img-fluid" src="img/about-imgage.png" alt="gambar"
                            style="max-width: 100%; height: auto;">
                    </div>
                    <div class="col-lg-6">
                        <div class="text-about">
                            <p style="font-size: 44px;"><b>Tentang Kami</b></p>
                            <p class="caption">PMJ Trans adalah layanan penyewaan bus pariwisata di Jl. Lingkar Timur
                                Ngembel, Kudus. Kami menyediakan armada berkualitas untuk perjalanan yang nyaman dan aman,
                                dengan fokus pada kepuasan pelanggan.</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-3 mb-4">
                                <div class="about-card card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">30+</h5>
                                        <p class="card-text">Bus</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 mb-4">
                                <div class="about-card card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">450+</h5>
                                        <p class="card-text">Jam Perjalanan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 mb-4">
                                <div class="about-card card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">50+</h5>
                                        <p class="card-text">Destinasi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 mb-4">
                                <div class="about-card card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">12k+</h5>
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
        <section id="testimoni" class="py-5">
            <div class="container container-testi">
                <div class="title text-center mb-5">
                    <p style="color: #1E9781; margin-bottom: 5px;">T E S T I M O N I</p>
                    <p style="font-size: 44px; font-weight: bold;">Kata Mereka</p>
                </div>

                <div id="carouselTestimoni" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators" style="margin-top: 50px;">
                        <button type="button" data-bs-target="#carouselTestimoni" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"
                            style="width: 15px; height: 15px; border-radius: 50%; background-color: #4ABDAC;"></button>
                        <button type="button" data-bs-target="#carouselTestimoni" data-bs-slide-to="1"
                            aria-label="Slide 2"
                            style="width: 15px; height: 15px; border-radius: 50%; background-color: #4ABDAC;"></button>
                        <button type="button" data-bs-target="#carouselTestimoni" data-bs-slide-to="2"
                            aria-label="Slide 3"
                            style="width: 15px; height: 15px; border-radius: 50%; background-color: #4ABDAC;"></button>
                    </div>

                    <div class="carousel-inner carousel-inner-testi">
                        <!-- Testimoni 1 -->
                        <div class="carousel-item active text-center">
                            <img src="img/avatar.png" class="testi-img mb-3" alt="Customer"
                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            <h5><b>Nida Aulia Karima</b></h5>
                            <p>Customer</p>
                            <div class="stars mb-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="testimonial-text mx-auto" style="max-width: 500px;">Saya suka PMJ Trans, ini adalah
                                tempat terbaik untuk membeli tiket dan membantu Anda menemukan liburan impian Anda.</p>
                        </div>

                        <!-- Testimoni 2 -->
                        <div class="carousel-item text-center">
                            <img src="img/avatar.png" class="testi-img mb-3" alt="Customer"
                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            <h5><b>Nida Aulia Karima</b></h5>
                            <p>Customer</p>
                            <div class="stars mb-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="testimonial-text mx-auto" style="max-width: 500px;">Saya suka PMJ Trans, ini adalah
                                tempat terbaik untuk membeli tiket dan membantu Anda menemukan liburan impian Anda.</p>
                        </div>

                        <!-- Testimoni 3 -->
                        <div class="carousel-item text-center">
                            <img src="img/avatar.png" class="testi-img mb-3" alt="Customer"
                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            <h5><b>Nida Aulia Karima</b></h5>
                            <p>Customer</p>
                            <div class="stars mb-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="testimonial-text mx-auto" style="max-width: 500px;">Saya suka PMJ Trans, ini adalah
                                tempat terbaik untuk membeli tiket dan membantu Anda menemukan liburan impian Anda.</p>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimoni"
                        data-bs-slide="prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimoni"
                        data-bs-slide="next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>

    <!-- FOOTER -->
    <x-footer-customer />



    <script>
        // Deteksi scroll dan tambahkan kelas navbar-scrolled
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('navbar');
            if (window.scrollY > 50) { // Scroll lebih dari 50px
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
