@extends('frontend.layouts.app')
@push('styles')
    <title>{{ $setting ? $setting->name : '#' }}</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/homepage-style.css') }}" rel="stylesheet" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- HEADER -->
    <section id="header">
        <div class="row container-fluid mb-5">
            <div class="col-md-7 flex-column d-flex justify-content-center align-item-center mb-5">
                <div class="header-text">
                    <h1 style="color: #1E9781;">Menghubungkan Anda ke Seluruh <span style="color: #FD9C07;">Destinasi🏝️</span></h1>
                    <div class="d-flex">
                        <button class="btn-pesan">
                            <a href="{{ route('booking') }}" style="text-decoration: none; color: white;">
                                Pesan Sekarang 
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </button>
                        <button class="btn-callAdmin">
                            <a href="https://api.whatsapp.com/send?phone={{ $setting ? $setting->contact : '#' }}&text=Halo,%20saya%20ingin%20bertanya" style="text-decoration: none;color: #686D77;">
                                <i class="fa-solid fa-phone"></i> 
                                Hubungi Admin
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-5 d-flex justify-content-center align-item-center mt-3">
                <img src="img/header-img.png" alt="header image" class="header-img img-fluid">
            </div>
        </div>
    </section>
    
    <!-- DAFTAR BUS -->
    <section id="daftarBus py-3">
        <div class="package-container container">
            <div class="text-content">
                <h5>Daftar <span>Bus {{ $setting ? $setting->name : '#' }}</span></h5>
                <p>Berikut daftar bus yang tersedia di {{ $setting ? $setting->name : '#' }}.</p>
            </div>

            <!-- Swiper -->
            <div class="swiper category-carousel" style="padding: 20px;">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    @forelse ($buses as $bus)
                        <div class="swiper-slide">
                            <div class="package-card card h-100">
                                <img src="{{ 'storage/' . $bus->images->first()->image ?? '#' }}" alt="Bus {{ $bus->name ?? '#' }}" class="img-fluid">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="package-card-title">{{ $bus->name ?? '#' }}</p>
                                        <div class="package-icon">
                                            <i class="fa-solid fa-star"></i> 4.8
                                        </div>
                                    </div>
                                    <p class="small">Jetbus 3+ Voyager Adiputro</p>
                                    <div class="row mt-3 mb-3 text-center">
                                        <div class="col-3 text-icon">
                                            <i class="fa-solid fa-bed"></i>
                                            <p>Bantal & Selimut</p>
                                        </div>
                                        <div class="col-3 text-icon">
                                            <i class="fa-solid fa-tv"></i>
                                            <p>Entertain System</p>
                                        </div>
                                        <div class="col-3 text-icon">
                                            <i class="fa-solid fa-mug-hot"></i>
                                            <p>Dispenser</p>
                                        </div>
                                        <div class="col-3 text-icon">
                                            <i class="fa-solid fa-bolt"></i>
                                            <p>USB Charger</p>
                                        </div>
                                    </div>
                                    <div class="detail-package d-flex justify-content-end">
                                        <button type="button" class="btn-detail">
                                            <a href="{{ route('bus.show', ['bus_name' => $bus->name]) }}" style="text-decoration:none; color: white;">Detail</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="package-card card h-100 text-center">
                                <div class="card-body">
                                    <p class="package-card-title">Tidak ada bus tersedia.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse

                    <!-- Additional slides... -->
                </div>
            </div>
            <!-- Navigation buttons -->
            <div class="category-carousel-prev package-control-prev"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="category-carousel-next package-control-next"><i class="fa-solid fa-chevron-right"></i></div>
        </div>
    </section>


    <!-- KENAPA -->
    <section id="why">
        <div class="container">
            <div class="text-content text-center">
                <h5>Kenapa Harus Sewa <span>di {{ $setting ? $setting->name : '#' }}?</span></h5>
                <p>Berikut alasan yang kenapa harus sewa di {{ $setting ? $setting->name : '#' }}</p>
            </div>

            <div class="row mt-5">
                <div class="col-md-4 mb-3" id="card1">
                    <div class="why-card card h-100 d-flex justify-content-center align-items-center">
                        <img class="img-fluid mb-4" src="img/why-image1.png" width="60px" height="60px" alt="images1">
                        <div class="card-body">
                            <h5 class="why-title">Banyak Pilihan</h5>
                            <p class="card-text">
                                Kami menyedikan banyak pilihan destinasi dan BUS yang dapat anda pilih, sesuai kebutuhan dan keinganan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3" id="card2">
                    <div class="why-card card h-100 d-flex justify-content-center align-items-center">
                        <img class="img-fluid mb-4" src="img/why-image2.png" width="60px" height="60px" alt="images2">
                        <div class="card-body">
                            <h5 class="why-title">Penyewaan Mudah</h5>
                            <p class="card-text">
                                {{ $setting ? $setting->name : '#' }} menyediakan penyewaan yang mudah dengan cara mengisi formulir dan kontak admin
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3" id="card3">
                    <div class="why-card card h-100 d-flex justify-content-center align-items-center">
                        <img class="img-fluid mb-4" src="img/why-image3.png" width="60px" height="60px" alt="images3">
                        <div class="card-body">
                            <h5 class="why-title">Harga Bersahabat</h5>
                            <p class="card-text">
                                Kami menyediakan tarif yang terjangkau dengan kendaraan modern, memastikan perjalanan Anda nyaman dan terpercaya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CARA PENYEWAAN -->
    <section id="caraPenyewaan">
        <div class="container-fluid cara-container">
            <div class="text-content text-center mb-5">
                <h5>Cara <span>Penyewaan</span></h5>
                <p>Ikuti langkah dibawah ini untuk melakukan penyewaan BUS di {{ $setting ? $setting->name : '#' }}</p>
            </div>

            <div class="row" style="background-image: url('img/bg-cara.png');">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <div class="mb-3">
                            <img src="img/cara1.png" class="img-fluid" alt="cara 1">
                        </div>
                        <h5>Pilih Bus</h5>
                        <p>Pilih bus yang tersedia dari layanan {{ $setting ? $setting->name : '#' }}.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <div class="mb-3">
                            <img src="img/cara2.png" class="img-fluid" alt="cara 2">
                        </div>
                        <h5>Pesan Bus</h5>
                        <p>Melalui Admin Atau Website dengan mengisi formulir pemesanan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <div class="mb-3">
                            <img src="img/cara3.png" class="img-fluid" alt="cara 3" style="margin-top: 20px;">
                        </div>
                        <h5>Konfirmasi Admin</h5>
                        <p>Konfirmasi via WhatsApp jika pemesanan melalui admin atau cek pemesanan jika menggunakan website.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cara-content text-center">
                        <div class="mb-3">
                            <img src="img/cara4.png" class="img-fluid" alt="cara 4">
                        </div>
                        <h5>Pembayaran</h5>
                        <p>Unggah bukti pembayaran DP, sisa pembayaran dapat dilakukan saat trip atau di Kantor {{ $setting ? $setting->name : '#' }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BANNER -->
    <section id="banner">
        <div class="container">
            <div class="banner-content">
                <div class="bg-banner">
                    <div class="banner-text text-center">
                        <h5>Butuh bantuan dari admin untuk pemesanan?</h5>
                        <p>
                            Jika anda membutuhkan bantuan admin untuk melakukan pemesanan bus di {{ $setting ? $setting->name : '#' }},<br>silahkan klik tombol dibawah ini
                        </p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn-banner">
                            <a href="https://api.whatsapp.com/send?phone={{ $setting ? $setting->contact : '#' }}&text=Halo,%20saya%20ingin%20memesan">
                                <b>Hubungi Admin</b>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONI -->
    <section id="testimoni" class="py-5">
        <div class="container container-testi">
            <div class="text-content text-center mb-5">
                <h5>Testimoni</h5>
                <p>Begini kata mereka yang sudah merasakan kenyamanan dan layanan terbaik dari {{ $setting ? $setting->name : '#' }}!</p>
            </div>  

            <div id="carouselTestimoni" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators" style="margin-top: 50px;">
                    @foreach ($reviews->take(3) as $index => $review)
                        <button type="button" data-bs-target="#carouselTestimoni" data-bs-slide-to="{{ $index }}" 
                            class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}" 
                            style="width: 15px; height: 15px; border-radius: 50%; background-color: #FD9C07;">
                        </button>
                    @endforeach
                </div>
            
                <div class="carousel-inner carousel-inner-testi">
                    @foreach ($reviews->take(3) as $index => $review)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} text-center">
                            <img src="{{ asset('img/avatar.png') }}" class="testi-img mb-3" alt="Customer" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            <h5>{{ $review->booking->customer->name }}</h5>
                            <p>Customer</p>
                            <div class="stars mb-3">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                                @for ($i = $review->rating; $i < 5; $i++)
                                    <i class="fas fa-star text-secondary"></i>
                                @endfor
                                
                            </div>
                            <p class="testimonial-text mx-auto" style="max-width: 500px;">{{ $review->feedback }}</p>
                        </div>
                    @endforeach
                </div>

                

                <button class="testi-control-prev" type="button" data-bs-target="#carouselTestimoni"
                    data-bs-slide="prev">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button class="testi-control-next" type="button" data-bs-target="#carouselTestimoni"
                    data-bs-slide="next">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq">
        <div class="container mt-5">
            <div class="text-content">
                <h5>Pertanyaan<span> Umum</span></h5>
                <p> Berikut beberapa pertanyaan yang sering diajukan tentang layanan sewa bus di {{ $setting ? $setting->name : '#' }}</p>
            </div>
    
            <div class="accordion accordion-flush" id="faq">
                @forelse ($faqs as $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq{{ $loop->iteration }}" aria-expanded="false">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="faq{{ $loop->iteration }}" class="accordion-collapse collapse"
                            data-bs-parent="#faq">
                            <div class="accordion-body">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                aria-expanded="true" disabled>
                                Tidak ada FAQ tersedia.
                            </button>
                        </h2>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer mt-5">
        <div class="container" style="padding: 50px 0px;">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-3 d-flex flex-column justify-content-center align-items-center" style="padding-right: 30px;">
                    <img src="{{ asset($setting->logo ? 'storage/' . $setting->logo : '#') }}" alt="Logo" height="85px">
                    <p class="caption1">{{ $setting ? $setting->footer : '#' }}</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <h6>Hubungi Kami</h6>
                    <ul class="list-unstyled">
                        <li>
                            <a href="https://g.co/kgs/VGfUFPB" target="_blank" style="text-decoration: none;">
                                {{ $setting ? $setting->address : '#' }}
                            </a>
                        </li>
                        <li><a href="mailto:{{ $setting ? $setting->email : '#' }}" target="_blank" style="text-decoration: none;">
                            {{ $setting ? $setting->email : '#' }}
                            </a>
                        </li>
                        <li>
                            <a href="https://api.whatsapp.com/send?phone={{ $setting ? $setting->contact : '#' }}&text=Halo,%20saya%20ingin%20bertanya" target="_blank" style="text-decoration: none;">
                                +{{ $setting ? $setting->contact : '#' }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-3" style="padding-left: 20px;">
                    <h6>Link Cepat</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" style="text-decoration: none;">Beranda</a></li>
                        <li><a href="{{ route('bus') }}" style="text-decoration: none;">Bus</a></li>
                        <li><a href="{{ route('about') }}" style="text-decoration: none;">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" style="text-decoration: none;">Kontak Kami</a></li>
                        <li><a href="{{ route('cek.status') }}" style="text-decoration: none;">Cek Pesanan</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6>Sosial Media</h6>
                    <div class="sosmed-icon">
                        <a href="{{ $setting->sosmed_ig ?? '#' }}" target="_blank" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $setting->sosmed_fb ?? '#' }}" target="_blank" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $setting->sosmed_yt ?? '#' }}" target="_blank" class="text-light mx-2"><i class="fa-brands fa-youtube"></i></a>
                        <a href="https://api.whatsapp.com/send?phone={{ $setting->contact ?? '#' }}&text=Halo,%20saya%20ingin%20bertanya" target="_blank" class="text-light mx-2"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>                    
                </div>
            </div>
        </div>
    </footer>
    <x-footer-customer />

    @push('scripts')
        <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
        <script>
            // Initialize Swiper
            var swiper = new Swiper('.category-carousel', {
                slidesPerView: 1, // Default for mobile
                spaceBetween: 20,
                navigation: {
                    nextEl: '.category-carousel-next',
                    prevEl: '.category-carousel-prev',
                },
                breakpoints: {
                    768: { // Tablet
                        slidesPerView: 2,
                    },
                    1250: { // Desktop
                        slidesPerView: 3,
                    }
                }
            });
        </script>
    @endpush
    <!-- Include Swiper JS -->
@endsection
