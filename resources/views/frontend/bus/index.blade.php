@extends('frontend.layouts.app')
@push('styles')
    <title>List Bus</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/bus-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />
    <section id="bus">
        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5 text-content wow animate__animated animate__fadeInLeft">
                    <h1 class="mb-4">Daftar Bus <span>{{ $setting ? $setting->name : '#' }} </span></h1>
                    <p>Temukan bus ideal Anda dengan pilihan kategori, rentang harga, dan kapasitas penumpang yang telah kami sediakan !</p>
                </div>
                <div class="col-md-6 wow animate__animated animate__fadeInRight">
                    <img class="img-fluid" src="{{ asset('img/listbust-img.png') }}" style="width: 100%; align-items:center; padding: 50px 30px; 0px 30px" alt="gambar">
                </div>
            </div>
        </div>
        <!-- Header End -->
        <div class="content">
            <div class="text-content wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                <h1>Bus 
                    <span>
                        {{ $setting ? $setting->name : '#' }}
                    </span>
                </h1>
                <p class="mb-4">
                    Temukan bus ideal Anda dengan pilihan kategori, rentang harga, dan kapasitas penumpang yang telah kami sediakan!
                </p>
            </div>
        </div>

        <!-- Property List Start -->
        <div class="container mt-5 mb-5">
            <!-- CARD BUS -->
            <div class="col-lg-12">
                <div class="row g-3 d-flex justify-content-center">
                    @forelse ($buses as $bus)
                        <div class="col-lg-4 col-md-6 mb-4 wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                            <div class="package-card card h-100">
                                <img src="{{ 'storage/' . $bus->images->first()->image ?? '#' }}" alt="Bus {{ $bus->name ?? '#' }}" class="img-fluid">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="package-card-title">{{ $bus->name ?? '#' }}</p>
                                        <div class="package-icon">
                                            <i class="fa-solid fa-star"></i> 
                                            {{ collect($busesWithRatings)->firstWhere('bus.id', $bus->id)['average_rating'] ?? '0.0' }} 
                                        </div>
                                    </div>
                                    <p class="small">{{ $bus->type ?? '#' }}</p>
                                    <div class="row mt-3 mb-3 text-center fasilitas-package">
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
                                        <button type="button" class="btn-detail"><a href="{{ route('bus.show', ['bus_name' => $bus->name]) }}" style="text-decoration:none; color: white;">Detail</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 mb-3">
                            <div class="alert alert-danger text-center">
                                <p class="package-card-title">Tidak ada bus tersedia!</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
    </section>
    <!-- FOOTER -->
    <x-footer-customer />

    @push('scripts')
        <script>
            new WOW().init();
        </script>
    @endpush
@endsection
