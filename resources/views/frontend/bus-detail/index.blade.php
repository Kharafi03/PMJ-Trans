@extends('frontend.layouts.app')
@push('styles')
    <title>Detail Bus</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/detailBus-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- CONTENT -->
    <section id="detailBus">
        <div class="container mt-5 mb-5">
            <h5 class="wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">Detail <span style="color: #FD9C07;">Bus</span></h5>
            <div class="bus-card mt-5 mb-5 wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-lg-6">
                        <div id="carouselExample" class="carousel slide carousel-fade wow animate__fadeInLeft">
                            <div class="carousel-inner">
                                @foreach ($bus->images as $index => $busImage)
                                    <div class="carousel-item image-container {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $busImage->image) }}" class="d-block img-fluid" alt="Bus Image {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>                            
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="row mt-2 wow slideInLeft" data-wow-delay="0.1s">
                            <div class="col-12 d-flex justify-content-center">
                                @foreach ($bus->images as $index => $busImage) <!-- Loop untuk menampilkan gambar -->
                                    <div class="col-2 thumbnail d-flex justify-content-center align-items-center mx-1">
                                        <div class="image-container">
                                            <img src="{{ asset('storage/' . $busImage->image) }}" data-bs-target="#carouselExample"
                                                data-bs-slide-to="{{ $index }}" alt="Bus Image {{ $index + 1 }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 mt-3">
                        <div class="d-flex justify-content-between">
                            <p class="bus-title">{{ $bus->name }}</p>
                            <div class="bus-star">
                                <i class="fa-solid fa-star"></i> {{ $formatStar }}
                            </div>
                        </div>
                        <p class="bus-type">{{ $bus->type ?? '#' }}</p>
                        <div class="row mt-4 text-center fasilitas mb-3">
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
                        <ul class="bus-description">
                            <li>Dilengkapi dengan AC, bantal, dan selimut untuk kenyamanan perjalanan.</li>
                            <li>Berbagai entertain system, seperti youtube android tv, subwoofer audio, wireless mic, dan karaoke.</li>
                            <li>Tempat duduk nyaman dengan seat 2-2.</li>
                        </ul>
                        <div class="d-flex justify-content-end align-items-center">
                            {{-- <button class="btn-back">Kembali</button> --}}
                            <a href="{{ route('bus') }}" class="btn-back">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimoni-content mt-5 mb-5">
                <h5 style="margin-bottom: 50px;" class="wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">Testimoni</h5>
                <div class="row">
                    <div class="col-lg-3 col-md-4 wow animate__animated animate__fadeInUp mb-4" data-wow-delay="0.7s">
                        <div class="filter">
                            <div class="filter-content">
                                <div class="filter-header">
                                    <p>Filter Rating</p>
                                </div>
                                <form id="filterForm">
                                    <div class="form-group">
                                        <select class="form-select" id="filterSelect">
                                            <option value="#" selected>Pilih Berdasarkan</option>
                                            <option value="terbaru">Terbaru</option>
                                            <option value="ratingTertinggi">Rating Tertinggi</option>
                                            <option value="ratingTerendah">Rating Terendah</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 wow animate__animated animate__fadeInUp" data-wow-delay="0.9s">
                        <div class="testimoni-container" id="reviewContainer">
                            @forelse ($reviews->take(5)->sortDesc() as $review)
                                <div class="testi review-item" data-date="{{ $review->created_at }}" data-rating="{{ $review->rating }}">
                                    <p class="tanggal-testi">
                                        {{ \Carbon\Carbon::parse($review->created_at)->translatedFormat('l, d F Y') }}
                                    </p>
                                    <div class="rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $review->rating)
                                                <i class="fa-solid fa-star text-warning"></i>
                                            @else
                                                <i class="fa-solid fa-star text-secondary"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="profile-card">
                                        <div class="profile-initial">
                                            {{ strtoupper(substr($review->booking->customer->name, 0, 1) . substr($review->booking->customer->name, strpos($review->booking->customer->name, ' ') + 1, 1)) }}
                                        </div>
                                        <div class="profile-text">
                                            <h5>{{ $review->booking->customer->name }}</h5>
                                        </div>
                                    </div>
                                    <p class="role">Customer</p>
                                    <div class="isi-testi">
                                        <p>{{ $review->feedback }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="testi">
                                    <div class="alert text-center">
                                        <h3><i class="fa-solid fa-triangle-exclamation"></i>Tidak ada ulasan tersedia!</h3>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />

    <!-- SELECT -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("filterSelect").selectedIndex = 0;
        });
    </script>

@endsection
@push('styles')
    <style>
        .thumbnail {
            object-fit: cover;
            cursor: pointer;
        }

        .img-fluid {
            height: auto;
            border-radius: 10px;
        }

        .custom-icon {
            font-size: 1.5rem;
        }

        .image-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            overflow: hidden;
            border-radius: 5px;
        }

        .image-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .profile-initial {
            width: 40px;
            height: 40px;
            background-color: #1E9781;
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 18px;
        }

        .filter {
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .filter-header p {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-select {
            width: 100%;
            max-width: 300px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#filterSelect').on('change', function() {
                const selectedFilter = $(this).val();
                const $reviews = $('#reviewContainer .review-item');

                let sortedReviews;
                
                if (selectedFilter === 'terbaru') {
                    // Urutkan berdasarkan tanggal terbaru
                    sortedReviews = $reviews.sort((a, b) => new Date($(b).data('date')) - new Date($(a).data('date')));
                } else if (selectedFilter === 'ratingTertinggi') {
                    // Urutkan berdasarkan rating tertinggi
                    sortedReviews = $reviews.sort((a, b) => $(b).data('rating') - $(a).data('rating'));
                } else if (selectedFilter === 'ratingTerendah') {
                    // Urutkan berdasarkan rating terendah
                    sortedReviews = $reviews.sort((a, b) => $(a).data('rating') - $(b).data('rating'));
                }

                // Kosongkan kontainer dan tambahkan elemen review yang sudah diurutkan
                $('#reviewContainer').html(sortedReviews);
            });
        });

    </script>
    <script>
        new WOW().init();
    </script>
@endpush