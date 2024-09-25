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
            <x-header-driver />
            <!-- BUS IMAGE -->
            <div class="mt-5">
                <div class="img-bus d-flex justify-content-center align-items-center mb-4">
                    <img src="img/image1.png" alt="bus">
                </div>
                <div class="tiket">
                    <div class="header-tiket ">
                        <p><img src="img/bus.png"> PMJ Trans</p>
                    </div>
                    <div class="content-tiket">
                        <div class="tujuan">
                            <div class="row">
                                <div class="col">
                                    <p>Pekalongan</p>
                                    <h5>PKL</h5>
                                </div>
                                <div class="col" style="text-align: right;">
                                    <p>Pekalongan</p>
                                    <h5>PKL</h5>
                                </div>
                            </div>
                        </div>
                        <div class="waktu">
                            <div class="row">
                                <div class="col">
                                    <h5>08.30 WIB</h5>
                                    <p>18 September 2024</p>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-start" >
                                    <img src="img/tiket-icon.png" >
                                </div>
                                <div class="col" style="text-align: right;">
                                    <h5>10.00 WIB</h5>
                                    <p>19 September 2024</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer-tiket">
                            <p>Durasi 1 Jam 15 Menit</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORM INPUT -->
            <div class="form-km p-3 mb-5">
                <form>
                    <div class="mb-3">
                        <label for="kmAwal" class="form-label">Kilometer Awal<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-gauge"></i></span>                      
                            <input type="text" class="form-control" id="kmAwal" placeholder="Masukkan Kilometer Awal" required>
                        </div>
                        <small class="text-danger" id="error" style="display: none;">Masukkan data kilometer awal.</small>
                    </div>
                    <!-- BUTTON -->
                    <div>
                        <button type="button" class="btn-inputkm" onclick="submitKmAwal()">Kirim</button>
                    </div>                     
                </form>
            </div>
            
            <!-- NAVBAR -->
             <x-navbar-driver/>
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