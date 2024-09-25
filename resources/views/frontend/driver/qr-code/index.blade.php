@extends('frontend.layouts.app')
@push('styles')
    <title>QR Qode</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/QRCode-style.css') }}" rel="stylesheet">
@endpush
@section('content')
<!-- CONTENT -->
<section id="qrCode">
    <div class="dashboard-container container p-3">
        <!-- HEADER -->
        <x-header-driver />
        <!-- CAMERA -->
        <div  class="d-flex justify-content-center align-items-center mb-3">
            <div id="camera-frame">
                <video id="camera-feed" autoplay></video>
                <!-- Adding corner frames -->
                <div class="corner-frame top-left"></div>
                <div class="corner-frame top-right"></div>
                <div class="corner-frame bottom-left"></div>
                <div class="corner-frame bottom-right"></div>
            </div>
        </div>
        
        <div class="text-content text-center">
            <p class="title">SCAN QR CODE DRIVER</p>
            <p class="caption">Silahkan Scan QR-Code diatas untuk memulai trip</p>
        </div>

        <!-- NAVBAR -->
        <x-navbar-driver />
        
    </div>
</section>


    <!-- SCRIPT CAMERA -->
    <script>
    // Akses kamera menggunakan API getUserMedia
    const video = document.getElementById('camera-feed');
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            video.srcObject = stream;
            video.play();
        })
        .catch(function(error) {
            console.error("Error accessing the camera", error);
        });
    } else {
        alert("getUserMedia not supported in this browser.");
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection