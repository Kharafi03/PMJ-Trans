@extends('frontend.layouts.app')
@push('styles')
    <title>Dashboard Driver</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/dashboardDriver-style.css') }}" rel="stylesheet">
     <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboard">
        <div class="dashboard-container container p-3">
            <div class="header mb-4">
                <p>Halo, Nida Aulia Karima!</p>
            </div>
            <div class="content">
                <img src="img/dashboard-img.png" alt="dashboard">
                <div class="text-img">
                    <p>Selamat Datang di Dashboard Driver</p>
                </div>
                <div>
                    <a href="{{ route('qr-code') }}">
                        <button class="btn-mulai">Mulai</button>
                    </a>
                </div>
            </div>
        </div>
     </section>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection