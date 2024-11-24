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
    <section id="header" class="container">
        <div class="row justify-content-center align-items-center mb-5">
            <div class="col-md-7 mb-5 wow animate__animated animate__fadeInLeft text-center text-md-start">
                <div class="header-text">
                    <h1 style="color: #1E9781;">Nikmati Kemudahan Sewa Bus Pariwisata dengan <span style="color: #FD9C07;">PMJ Trans</span></h1>

                    <div class="icon-cek">
                        <p><i class="fa-solid fa-check"></i> Pesan bus dengan mudah</p>
                        <p><i class="fa-solid fa-check"></i> Aman dalam perjalanan</p>
                        <p><i class="fa-solid fa-check"></i> Nyaman sepanjang perjalanan</p>
                    </div>

                    <div class="d-flex justify-content-start">
                        <button class="btn-pesan">
                            <a href="{{ route('booking') }}" style="text-decoration: none; color: white;">
                                Pesan Sekarang 
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </button>
                        <button class="btn-yt ms-2">
                            <a href="{{ $setting->sosmed_yt ?? '#' }}" target="_blank" style="text-decoration: none;color: #686D77;">
                                <i class="fa-brands fa-youtube"></i>
                                PMJ Trans
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-3 wow animate__animated animate__fadeInRight text-center">
                <img src="img/header-img.png" alt="header image" class="header-img img-fluid">
            </div>
        </div>
    </section>

    
    <!-- DAFTAR BUS -->
    <section id="daftarBus py-3">
        <div class="package-container container wow animate__animated animate__fadeInUp" data-wow-delay="0.7s">
            <div class="text-content">
                <h5>Daftar <span>Bus {{ $setting ? $setting->name : '#' }}</span></h5>
                <p>Berikut daftar bus yang tersedia di {{ $setting ? $setting->name : '#' }}.</p>
            </div>

            <!-- Swiper -->
            <div class="swiper category-carousel" style="width: 95%; margin: 0 auto;">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    @forelse ($buses as $bus)
                        <div class="swiper-slide wow animate__animated animate__fadeInUp">
                            <div class="package-card card h-100 mb-4">
                                <img src="{{ 'storage/' . $bus->images->first()->image ?? '#' }}" alt="Bus {{ $bus->name ?? '#' }}" class="img-fluid">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="package-card-title">{{ $bus->name ?? '#' }}</p>
                                        <div class="package-icon">
                                            <i class="fa-solid fa-star"></i> {{ collect($busesWithRatings)->firstWhere('bus.id', $bus->id)['average_rating'] ?? '0.0' }}
                                        </div>
                                    </div>
                                    <p class="small" style="font-family: 'Poppins', sans-serif; opacity: 50%;">{{ $bus->type ?? '#' }}</p>
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
        <div class="container wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
            <div class="text-content text-center">
                <h5>Kenapa Harus Sewa <span>di {{ $setting ? $setting->name : '#' }}?</span></h5>
                <p>Berikut alasan yang kenapa harus sewa di {{ $setting ? $setting->name : '#' }}</p>
            </div>

            <div class="row mt-5 why-content">
                <div class="col-md-4 mb-4 wow animate__animated animate__fadeInUp" data-wow-delay="0.5s" id="card1">
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
                <div class="col-md-4 mb-4 wow animate__animated animate__fadeInUp" data-wow-delay="0.7s" id="card2">
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
                <div class="col-md-4 mb-4 wow animate__animated animate__fadeInUp" data-wow-delay="0.9s" id="card3">
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
        <div class="text-content text-center mb-5 wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
            <h5>Cara <span>Pemesanan</span></h5>
            <p>Ikuti langkah dibawah ini untuk melakukan pemesanan BUS di {{ $setting ? $setting->name : '#' }}</p>
        </div>
        <div style="background-image: url('img/bg-cara.png');" class="wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
            <div class="container cara-container wow animate__animated animate__fadeInUp" data-wow-delay="0.7s">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4 wow animate__animated animate__fadeInUp" data-wow-delay="0.9s">
                        <div class="cara-content text-center">
                            <div class="mb-3">
                                <img src="img/cara1.png" class="img-fluid" alt="cara 1" style="padding-top: 20px; height: 185px !important;">
                            </div>
                            <h5>Pesan Bus</h5>
                            <p>Melalui Website pada tombol “Pesan Sekarang”  Atau Admin pada tombol “Hubungi Admin”.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 wow animate__animated animate__fadeInUp" data-wow-delay="1s">
                        <div class="cara-content text-center">
                            <div class="mb-3">
                                <img src="img/cara2.png" class="img-fluid" alt="cara 2" style=" height:170px; padding-top: 20px;">
                            </div>
                            <h5>Lengkapi Form Pemesanan</h5>
                            <p>Lengkapi Formulir Pemesanan yang telah disedikan.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 wow animate__animated animate__fadeInUp" data-wow-delay="1.2s">
                        <div class="cara-content text-center">
                            <div class="mb-3">
                                <img src="img/cara3.png" class="img-fluid" alt="cara 3" style="margin-top: 20px; height:170px; ">
                            </div>
                            <h5>Konfirmasi Admin</h5>
                            <p>Cek pemesanan jika melalui website, atau konfirmasi via WhatsApp jika pemesanan dilakukan oleh admin.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4 wow animate__animated animate__fadeInUp" data-wow-delay="1.3s">
                        <div class="cara-content text-center">
                            <div class="mb-3">
                                <img src="img/cara4.png" class="img-fluid" alt="cara 4" style="padding-top: 30px; height:185px; ">
                            </div>
                            <h5>Pembayaran</h5>
                            <p>Unggah bukti pembayaran DP, sisa pembayaran dapat dilakukan saat trip atau di Kantor {{ $setting ? $setting->name : '#' }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BANNER -->
    <section id="banner">
        <div class="container wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
            <div class="banner-content">
                <div class="bg-banner">
                    <div class="banner-text text-center">
                        <h5>Butuh bantuan dari admin <span>untuk pemesanan?</span></h5>
                        <p>
                            Jika anda membutuhkan bantuan admin untuk melakukan pemesanan bus di {{ $setting ? $setting->name : '#' }},<br>silahkan klik tombol dibawah ini
                        </p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn-banner">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone={{ $setting ? $setting->contact : '#' }}&text=Halo%20PMJ%20Trans%2C%0A%0ASaya%20ingin%20mengetahui%20informasi%20lebih%20lanjut%20mengenai%20ketersediaan%20dan%20harga%20untuk%20pemesanan%20ini.%0A%0ADetail%20Pemesanan%3A%0A*%20Tujuan%201%20%3A%20%5BMasukkan%20Nama%20dan%20Kota%20Tujuan%5D%0A*keterangan%20%3A%20bisa%20menambah%20tujuan%20lebih%20dari%201%20tujuan.%0A*%20Tujuan%20Akhir%20%3A%20%5BMasukkan%20Nama%20dan%20Kota%20Tujuan%5D%0A*%20Jumlah%20Penumpang%3A%20%5BMasukkan%20Jumlah%20Penumpang%5D%0A*%20Leg%20Rest%3A%20%5BYa%2FTidak%5D%0A*%20Deskripsi%3A%20%5BSilahkan%20isi%20detail%20jumlah%20legrest%2C%20jika%20memilih%20%22YA%22%20menggunakan%20Legrest%2C%20Jika%20%22TIDAK%22%20menggunakan%20Legrest%2C%20silahkan%20kosongi%5D%0A*%20Tanggal%20Mulai%3A%20%5BMasukkan%20Tanggal%20Mulai%5D%0A*%20Titik%20Jemput%3A%20%5BMasukkan%20Alamat%20Titik%20Jemput%20Lengkap%5D%0A%0ADetail%20Kontak%3A%0A*%20Nama%3A%20%5BMasukkan%20Nama%20Lengkap%5D%0A*%20Nomor%20WhatsApp%3A%20%5BMasukkan%20Nomor%20WhatsApp%20Aktif%5D%0A*%20Email%3A%20%5BMasukkan%20Alamat%20Email%5D%0A*%20Alamat%3A%20%5BMasukkan%20Alamat%20Lengkap%5D%0A%0AMohon%20lengkapi%20Detail%20Pemesanan%20dan%20Detail%20Kontak%2C%20agar%20pesanan%20yang%20anda%20inginkan%20segera%20kami%20proses.%0A%0ATerima%20kasih.">
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
        <div class="container container-testi wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
            <div class="text-content text-center mb-5">
                <h5>Testimoni</h5>
                <p>Begini kata mereka yang sudah merasakan kenyamanan dan layanan terbaik dari {{ $setting ? $setting->name : '#' }}!</p>
            </div>  

            <div id="carouselTestimoni" class="carousel slide wow animate__animated animate__fadeInUp" data-wow-delay="0.6s" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-indicators" style="margin-top: 50px;">
                    @foreach ($reviews->take(3) as $index => $review)
                        <button type="button" data-bs-target="#carouselTestimoni" data-bs-slide-to="{{ $index }}" 
                            class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}" 
                            style="width: 15px; height: 15px; border-radius: 50%; background-color: #FD9C07;">
                        </button>
                    @endforeach
                </div>
            
                <div class="carousel-inner carousel-inner-testi d-flex justify-content center align-items-center">
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
        <div class="container mt-5 wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
            <div class="text-content">
                <h5>Pertanyaan<span> Umum</span></h5>
                <p> Berikut beberapa pertanyaan yang sering diajukan tentang layanan sewa bus di {{ $setting ? $setting->name : '#' }}</p>
            </div>
    
            <div class="accordion accordion-flush" id="faq">
                @forelse ($faqs as $faq)
                    <div class="accordion-item wow animate__animated animate__fadeInUp" data-wow-delay="0.6s">
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
    <section id="footer">
        <footer class="footer mt-5">
            <div class="container" style="padding: 50px 0px;">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3 d-flex flex-column justify-content-center align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0.5s" style="padding-right: 30px;">
                        <img src="{{ asset($setting->logo ? 'storage/' . $setting->logo : '#') }}" alt="Logo" height="85px">
                        <p class="caption1">{{ $setting ? $setting->footer : '#' }}</p>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.7s" style="padding-right: 30px !important;">
                        <h6>Hubungi Kami</h6>
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ $setting ? $setting->link_maps : '#' }}" target="_blank" style="text-decoration: none;">
                                    {{ $setting ? $setting->address : '#' }}
                                </a>
                            </li>
                            <li><a href="mailto:{{ $setting ? $setting->email : '#' }}" target="_blank" style="text-decoration: none;">
                                {{ $setting ? $setting->email : '#' }}
                                </a>
                            </li>
                            <li>
                                <a href="#footer" style="text-decoration: none;">Jam Buka<br>({{ $setting->open_hours ? $setting->open_hours : '#' }})</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-3 wow animate__animated animate__fadeInUp" data-wow-delay="0.9s" style="padding-left: 20px;">
                        <h6>Link Cepat</h6>
                        <ul class="list-unstyled">
                            <li><a href="#" style="text-decoration: none;">Beranda</a></li>
                            <li><a href="{{ route('bus') }}" style="text-decoration: none;">Bus</a></li>
                            <li><a href="{{ route('about') }}" style="text-decoration: none;">Tentang Kami</a></li>
                            <li><a href="{{ route('contact') }}" style="text-decoration: none;">Kontak Kami</a></li>
                            <li><a href="{{ route('cek.status') }}" style="text-decoration: none;">Cek Pesanan</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="1.1s">
                        <h6 class="sosmed">Sosial Media</h6>
                        <div class="sosmed-icon">
                            <a href="{{ $setting->sosmed_ig ?? '#' }}" target="_blank" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $setting->sosmed_fb ?? '#' }}" target="_blank" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $setting->sosmed_yt ?? '#' }}" target="_blank" class="text-light mx-2"><i class="fa-brands fa-youtube"></i></a>
                        </div>                    
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <x-footer-customer />

    @push('scripts')
        <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
        <script>
            var swiper = new Swiper('.category-carousel', {
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.category-carousel-next',
                    prevEl: '.category-carousel-prev',
                },
                breakpoints: {
                    768: { 
                        slidesPerView: 2,
                    },
                    1250: {
                        slidesPerView: 3,
                    }
                }
            });
        </script>
        <script>
            new WOW().init();
        </script>
    @endpush
@endsection
