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
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 style="font-size: 44px; font-weight: 700; color: #1E9781;">
                        Daftar Bus
                        <span style="color: #FD9C07;">{{ $setting ? $setting->name : '#' }} </span>
                    </h1>
                    <p class="mb-4" style="font-size: 16px; font-weight: 500; color: #666666B5;">
                        Temukan bus ideal Anda dengan pilihan kategori, rentang harga, dan kapasitas penumpang yang telah kami sediakan !
                    </p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('img/listbust-img.png') }}" style="width: 100%; align-items:center; padding: 50px 30px; 0px 30px" alt="gambar">
                </div>
            </div>
        </div>
        <!-- Header End -->

        <div style="margin: 50px 0px 0px 50px;">
            <h1 style="font-size: 44px; font-weight: 700; color: #1E9781;">
                Daftar Bus 
                <span style="color: #FD9C07;">
                    {{ $setting ? $setting->name : '#' }}
                </span>
            </h1>
            <p class="mb-4" style="font-size: 20px; font-weight: 600; color: #666666B5;">
                Temukan bus ideal Anda dengan pilihan kategori, rentang harga, dan kapasitas penumpang yang telah kami sediakan!
            </p>
        </div>

        <!-- Property List Start -->
        <div class="container px-5 mt-5 mb-5">
            <!-- CARD BUS -->
            <div class="col-lg-12">
                <div class="row g-5 d-flex justify-content-center">
                    @forelse ($buses as $bus)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="package-card card h-100">
                                <img src="{{ 'storage/' . $bus->images->first()->image ?? '#' }}" alt="Bus {{ $bus->name ?? '#' }}" class="img-fluid">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="package-card-title">{{ $bus->name ?? '#' }}</p>
                                        <div class="package-icon">
                                            <i class="fa-solid fa-star"></i> 
                                            {{-- tampilkan disini --}}
                                            {{ collect($busesWithRatings)->firstWhere('bus.id', $bus->id)['average_rating'] ?? '0.0' }} 
                                        </div>
                                    </div>
                                    <p class="small">Jetbus 3+ Voyager Adiputro</p>
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
                                            <i class="fa-solid fa-shower"></i>
                                            <p>Shower</p>
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
@endsection
