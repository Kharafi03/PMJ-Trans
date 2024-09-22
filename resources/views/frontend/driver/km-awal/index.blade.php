@extends('frontend.layouts.app')
@push('styles')
    <title>Kilometer Awal</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/kmAwal-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardKm">
        <!-- HEADER -->
        <div class="dashboard-container container p-3">
            <div class="header mb-4">
                <p>Halo, Nida Aulia Karima!</p>
            </div>
            <!-- BUS IMAGE -->
            <div class="content d-flex justify-content-center align-items-center mb-3">
                <div class="card">
                    <img class="img-fluid" src="img/image1.png" alt="bus">
                    <div class="card-body">
                    <p class="text-title">Nama Bus</p>
                    <p class="text-icon"><i class="fa-solid fa-ticket-simple"></i> Kode Bus : PMJ7777777</p>
                    </div>
                </div>
            </div>
            <!-- FORM INPUT -->
            <div class="form-km p-3 mb-5">
                <form id="formKmAwal">
                    <div class="mb-3">
                        <label for="kmAwal" class="form-label">Kilometer Awal<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-gauge"></i></span>                      
                            <input type="text" class="form-control" id="kmAwal" placeholder="Masukkan Kilometer Awal" required autofocus>
                        </div>
                        <small class="text-danger" id="error-input" style="display: none;">Masukkan data kilometer awal.</small>
                    </div>
                    <!-- BUTTON -->
                    <div class="mb-3">
                        <button type="button" class="btn-inputkm" onclick="submitKmAwal()">Kirim</button>
                    </div>                     
                </form>
            </div>
        
            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>

<script>
    //SCRIPT ALERT
    function submitKmAwal() {
        // Ambil nilai field
        var kmAwal = document.getElementById('kmAwal').value;

        // Validasi
        var isValid = true;

        // Reset pesan error
        document.getElementById('error-input').style.display = 'none';

        // Validasi inputan
        if (kmAwal === "") {
            document.getElementById('error-input').style.display = 'block';
            isValid = false;
        }

        if (isValid) {
            swal({
                title: "Berhasil!",
                text: "Data berhasil dikirim.",
                icon: "success",
                button: true
            }).then(() => {
                // Redirect ke halaman input data
                window.location.href = "{{ route('input-data') }}";
            });
        } else {
            swal({
                title: "Error!",
                text: "Data harus diisi!",
                icon: "error",
                button: true
            });
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection