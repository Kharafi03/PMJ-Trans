@extends('frontend.layouts.app')
@push('styles')
    <title>Welcome Screen</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/welcomeScreen-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <section id="welcomeScreen">
        <div class="welcome-container container p-3" style="background-image: url('img/bg5.png');">
            <div class="welcome-screen mt-4 d-flex justify-content-center">
                <img src="img/welcome-image.png" class="img-fluid" width="300px" height="350px">
            </div>
            <div class="text-content text-center mt-4">
                <h5>Selamat Datang</h5>
                <p>Berkendaralah dengan hati-hati</p>
            </div>
            <div class="btn-content d-flex justify-content-center align-items-center">
                <button type="button" class="btn-dashboard"><a href="{{ route('dashboard-driver') }}">Dashboard</a></button>
            </div>
        </div>
    </section>
@endsection