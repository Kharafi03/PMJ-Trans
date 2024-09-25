@extends('frontend.layouts.app')
@push('styles')
    <title>No Trip</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/noTrip-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <section id="noTrip">

        <!-- INI MUNCUL KETIKA DI DASHBOARD DRIVER TIDAK ADA TRIP -->
        <div class="notrip-container container p-3">
            <!-- HEADER -->
             <x-header-driver/>
            
            <!-- TEXT CONTENT -->
            <div class="text-content mb-3">
                <p>Wahh.. Hari ini belum ada trip!</p>
            </div>

            <!-- IMAGE -->
            <div class="image-content">
                <img src="img/notrip-image.png">
            </div>

            <!-- BUTTON -->
            <div class="btn-content d-flex justify-content-center align-items-center p-3">
                <button type="button" class="btn-trip" disabled><a href="">Mulai</a></button>
            </div>
            
            <!-- NAVBAR -->
             <x-navbar-driver/>
        </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection