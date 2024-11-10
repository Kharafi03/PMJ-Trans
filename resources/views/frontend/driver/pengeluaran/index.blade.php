@extends('frontend.layouts.app')
@push('styles')
    <title>Form Pengeluaran</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/formPengeluaran-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardKm">
        <div class="dashboard-container container p-3">
            <!-- HEADER -->
            <!-- <x-header-driver /> -->

            <!-- TEXT CONTENT -->
            <div class="text-content text-start mb-4">
                <div class="row">
                    <div class="col-2" style="margin-right: -20px;">
                        <a href="{{ route('dashboard-trip') }}"><i class="fa-solid fa-chevron-left"></i></a>
                    </div>
                    <div class="col-10">
                        <h5 style="font-size: 20px; font-weight: 700; color: #1E9781;">Pengeluaran Saat <span style="color: #FD9C07;">Trip</span></h5>
                        <p class="caption">Masukkan data saat trip berlangsung</p>
                    </div>
                </div>
            </div>
            @include('frontend.assets.alert')

            <!-- FORM -->
            <div class="form-pengeluaran p-3">
                <form id="formPengeluaran" action="{{ route('spend-trip.store', ['tripId' => $trip->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Input untuk latitude dan longitude -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <div class="mb-3">
                        <label for="id_m_spend" class="form-label">Jenis Pengeluaran<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-file-lines"></i></span>
                            <select class="form-select" id="id_m_spend" name="id_m_spend" required>
                                <option selected value="">Pilih Jenis Pengeluaran</option>
                                @foreach ($spends as $spend)
                                    <option value="{{ $spend->id }}">{{ $spend->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Pengeluaran<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-book"></i></span>
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Deskripsi pengeluaran" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-money-bill-wave"></i></span>
                            <input type="number" class="form-control" id="nominal" name="nominal"
                                placeholder="Nominal yang dikeluarkan" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kilometer" class="form-label">Kilometer Speedometer<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-road"></i></span>
                            <input type="number" class="form-control" id="kilometer" name="kilometer"
                                placeholder="Kilometer speedometer" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image_receipt" class="form-label">Upload Bukti Pengeluaran <span
                                class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image_receipt" name="image_receipt" required
                                accept="image/*">
                            <label class="custom-file-label" for="image_receipt">
                                <i class="fa-solid fa-arrow-up-from-bracket" style="padding-left: 10px; color:#595c5f; border: 1px solid #666666;"></i>
                                Pilih file
                            </label>
                        </div>
                    </div>
                    <!-- PETA LOKASI -->
                    <div style="margin: 10px 0;">
                        <h5 style="font-size: 16px; font-weight: 400; color: #292D32;">Peta Lokasi</h5>
                        <iframe id="map" width="100%" height="200" style="border:0;" loading="lazy"></iframe>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn-kirim">Kirim</button>
                    </div>
                </form>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>

    <script>
        function requestLocation() {
            // Cek apakah geolocation tersedia
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Dapatkan latitude dan longitude
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Isi input tersembunyi
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;

                    // Update peta dengan lokasi pengguna
                    const MapURL = "https://maps.google.com/maps?q=" + latitude + "," + longitude + "&z=6&output=embed";
                    document.getElementById('map').src = MapURL;

                    alert("Lokasi berhasil diambil: " + latitude + ", " + longitude);
                }, function(error) {
                    // Menangani error
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            alert("Izin untuk mengakses lokasi ditolak. Silakan izinkan akses lokasi di pengaturan browser Anda.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("Informasi lokasi tidak tersedia.");
                            break;
                        case error.TIMEOUT:
                            alert("Permintaan untuk mendapatkan lokasi pengguna telah timeout.");
                            break;
                        case error.UNKNOWN_ERROR:
                            alert("Terjadi kesalahan yang tidak diketahui.");
                            break;
                    }
                }, {
                    enableHighAccuracy: true,
                    timeout: 1000,
                    maximumAge: 0
                });
            } else {
                alert('Geolocation tidak didukung oleh browser ini.');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Minta izin akses lokasi saat halaman dimuat
            requestLocation();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const numberInputs = document.querySelectorAll('input[type="number"]');

            numberInputs.forEach(function(input) {
                // Prevent "-" from being entered
                input.addEventListener('keypress', function(event) {
                    if (event.which === 45 || event.key === '-') {
                        event.preventDefault();
                    }
                });

                // Remove any negative signs that might have been pasted
                input.addEventListener('input', function() {
                    let value = input.value;
                    if (value.indexOf('-') !== -1) {
                        input.value = value.replace('-', '');
                    }
                });

                // Ensure no negative value remains after input loses focus
                input.addEventListener('blur', function() {
                    let value = input.value;
                    if (value < 0) {
                        input.value = Math.abs(value); // Convert negative to positive
                    }
                });
            });
        });
    </script>
@endsection
