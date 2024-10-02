@extends('frontend.layouts.app')
@push('styles')
    <title>Form Pengeluaran</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/formPengeluaran-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardKm">
        <div class="dashboard-container container p-3">
            <!-- HEADER -->
            <x-header-driver />
            <!-- TEXT CONTENT -->
            <div class="text-content text-center">
                <p class="title">DATA PERJALANAN</p>
            </div>
            <!-- FORM -->
            <div class="form-pengeluaran p-3">
                <form id="formPengeluaran" action="{{ route('spend-trip.store', ['tripId' => $trip->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Input untuk latitude dan longitude -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <div class="mb-3">
                        <label for="id_m_spend" class="form-label">Jenis Pengeluaran<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-wrench"></i></span>
                            <select class="form-select" id="id_m_spend" name="id_m_spend" required>
                                <option selected value="">Pilih Jenis Pengeluaran</option>
                                @foreach ($spends as $spend)
                                    <option value="{{ $spend->id }}">{{ $spend->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Deskripsi pengeluaran" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-wallet"></i></span>
                            <input type="number" class="form-control" id="nominal" name="nominal"
                                placeholder="Nominal yang dikeluarkan" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kilometer" class="form-label">Kilometer Speedometer<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-gauge"></i></span>
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
                                <i class="fa-solid fa-arrow-up-from-bracket" style="padding-left: 10px; color:#595c5f;"></i>
                                Pilih file
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="text-danger">*Wajib Diisi.</p>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn-kirim">Kirim</button>
                    </div>
                    <div class="mb-3">
                        <h5>Peta Lokasi</h5>
                        <iframe id="map" width="100%" height="200" style="border:0;" loading="lazy"></iframe>
                    </div>
                </form>
            </div>

            <!-- PETA LOKASI -->

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
