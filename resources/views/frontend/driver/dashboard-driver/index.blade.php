@extends('frontend.layouts.app')
@push('styles')
    <title>Dashboard Driver</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/dashboardDriver-style.css') }}" rel="stylesheet">
     <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboard">

        <!-- HEADER -->
        <div class="dashboard-container container p-3">
            <x-header-driver/>

            <!-- TEXT CONTENT -->
            <div class="text-content">
                <p>Semangat.. Hari ini ada trip!</p>
            </div>

            <!-- TITLE -->
            <div class="title">
                <p>Booking yang akan datang</p>
            </div>       
            <!-- CARD -->
            <div class="card-content">
                <div class="banner" style="background-image: url('img/banner.png');">
                    <div class="banner-isi">
                        <div class="header">
                            <p>PMJOKE123</p>
                            <h5>PMJOKE123</h5>
                        </div>
                        <div class="row tujuan"> 
                            <div class="col-4 col-md-6 col-lg-4"> 
                                <p>Semarang</p>
                                <p>(SMG)</p>
                            </div>
                            <div class="col-4 col-md-6 col-lg-4">
                                <p>Pekalongan</p>
                                <p>(PKL)</p>
                            </div>
                        </div>
                            <button type="button" class="btn-lihat mt-3">Lihat</button>
                    </div>
                </div>
                <div class="banner" style="background-image: url('img/banner.png');">
                    <div class="banner-isi">
                        <div class="header">
                            <p>PMJOKE123</p>
                            <h5>PMJOKE123</h5>
                        </div>
                        <div class="row tujuan"> 
                            <div class="col-4 col-md-6 col-lg-4"> 
                                <p>Semarang</p>
                                <p>(SMG)</p>
                            </div>
                            <div class="col-4 col-md-6 col-lg-4">
                                <p>Pekalongan</p>
                                <p>(PKL)</p>
                            </div>
                        </div>
                            <button type="button" class="btn-lihat mt-3">Lihat</button>
                    </div>
                </div>
                <div class="banner" style="background-image: url('img/banner.png');">
                    <div class="banner-isi">
                        <div class="header">
                            <p>PMJOKE123</p>
                            <h5>PMJOKE123</h5>
                        </div>
                        <div class="row tujuan"> 
                            <div class="col-4 col-md-6 col-lg-4"> 
                                <p>Semarang</p>
                                <p>(SMG)</p>
                            </div>
                            <div class="col-4 col-md-6 col-lg-4">
                                <p>Pekalongan</p>
                                <p>(PKL)</p>
                            </div>
                        </div>
                            <button type="button" class="btn-lihat mt-3">Lihat</button>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <button type="button" class="btn-mulai">Mulai Trip</button>
            </div>
            
            <!-- NAVBAR -->
            <x-navbar-driver/>
        </div>
     </section>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection