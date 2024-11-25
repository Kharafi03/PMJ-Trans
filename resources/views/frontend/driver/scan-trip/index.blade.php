@extends('frontend.layouts.app')
@push('styles')
    <title>Scan Trip</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/QRCode-style.css') }}" rel="stylesheet">
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="qrCode">
        <div class="dashboard-container container p-3">
            <div class="text-content text-start mb-4">
                <div class="row">
                    <div class="col-2" style="margin-right: -20px;">
                        <a href="{{ route('dashboard-driver') }}"><i class="fa-solid fa-chevron-left"></i></a>
                    </div>
                    <div class="col-10">
                        <h5 style="font-size: 20px; font-weight: 700; color: #1E9781;">Scan QR Code <span style="color: #FD9C07;">Driver</span></h5>
                        <p class="caption">Silahkan Scan QR-Code diatas untuk memulai trip</p>
                    </div>
                </div>
            </div>
            <!-- CAMERA -->
            <div class="d-flex justify-content-center align-items-center mb-3 p-3">
                <div id="reader"></div>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />

        </div>
    </section>

    <!-- SCRIPT CAMERA -->
    <script src="{{ asset('js/html5-qrcode.min.js') }}" type="text/javascript"></script>
    <script>
        const scanner = new Html5QrcodeScanner('reader', {
            qrbox: {
                width: 300, // Ukuran diperbesar
                height: 300
            },
            fps: 10, // Frekuensi scan diturunkan
        });

        // Fungsi pemrosesan setelah QR Code berhasil dipindai
        function success(result) {
            try {
                console.log(result);
                scanner.clear(); // Hentikan scanner setelah berhasil
                document.getElementById("reader").remove();
                // Redirect ke halaman terkait bus_code
                window.location.href = `/driver/trip/scan/${result}`;
            } catch (error) {
                console.error("Error saat memproses QR code: ", error);
            }
        }

        // Fungsi untuk menangani error pada saat scanning
        function error(err) {
            try {
                console.warn("Scanning error: ", err);
            } catch (e) {
                console.error("Unexpected error during QR code scan: ", e);
            }
        }

        scanner.render(success, error);
    </script>
@endsection
