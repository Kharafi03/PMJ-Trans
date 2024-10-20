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

            <div class="text-content text-center mb-4">
                <h5 style="font-size: 25px; font-weight: 700; color: #1E9781;">SCAN QR CODE <span style="color: #FD9C07;">DRIVER</span></h5>
                <p class="caption">Silahkan Scan QR-Code diatas untuk memulai trip</p>
            </div>
            <!-- CAMERA -->
            <div class="d-flex justify-content-center align-items-center mb-3">
                <div id="reader"></div>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />

        </div>
    </section>

    <!-- SCRIPT CAMERA -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
