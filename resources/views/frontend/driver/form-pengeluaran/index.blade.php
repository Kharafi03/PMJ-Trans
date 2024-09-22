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
            <div class="header mb-4">
                <p>Halo, Nida Aulia Karima!</p>
            </div>
            <!-- TEXT CONTENT -->
            <div class="text-content text-center">
                <p class="title">DATA PERJALANAN</p>
            </div>
            <!-- BUTTON -->
            <div class="p-3 mb-4">
                <div class="mb-3">
                    <button class="btn-pengeluaran" disabled>
                    <div class="btn-container">
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="text">
                            <h6>Pengeluaran Saat Trip</h6>
                            <p>Masukan data saat trip dimulai</p>
                        </div>
                    </div>
                </button>
                </div>              
            </div>
            <!-- FORM -->
            <div class="form-pengeluaran p-3 mb-5">
                <form id="formPengeluaran">
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Pengeluaran<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-wrench"></i></span>                      
                            <select class="form-select" id="jenis">
                                <option selected value="">Pilih Jenis Pengeluaran</option>
                                <option value="bbm">BBM</option>
                                <option value="makan">Makan</option>
                                <option value="parkir">Parkir</option>
                                <option value="tol">Tol</option>
                                <option value="service">Service Darurat</option>
                            </select>
                        </div>
                        <small class="text-danger" id="error-jenis" style="display: none;">Pilih jenis pengeluaran.</small>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-pen-to-square"></i></span>                      
                            <input type="text" class="form-control" id="deskripsi" placeholder="Deskripsi pengeluaran">
                        </div>
                        <small class="text-danger" id="error-deskripsi" style="display: none;">Lengkapi data deskripsi pengeluaran.</small>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-wallet"></i></span>                      
                            <input type="number" class="form-control" id="jumlah" placeholder="Jumlah yang dikeluarkan">
                        </div>
                        <small class="text-danger" id="error-jumlah" style="display: none;">Lengkapi data jumlah yang dikeluarkan.</small>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-wallet"></i></span>                      
                            <input type="text" class="form-control" id="nominal" placeholder="Nominal yang dikeluarkan">
                        </div>
                        <small class="text-danger" id="error-nominal" style="display: none;">Lengkapi data nominal yang dikeluarkan.</small>
                    </div>
                    <div class="mb-3">
                        <label for="speedometer" class="form-label">Kilometer Speedometer<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-gauge"></i></span>                      
                            <input type="text" class="form-control" id="speedometer" placeholder="Kilometer speedometer">
                        </div>
                        <small class="text-danger" id="error-speedometer" style="display: none;">Lengkapi data kilometer speedometer.</small>
                    </div>
                    <div class="mb-3">
                        <label for="bukti" class="form-label">Upload Bukti Pengeluaran<span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bukti" hidden>
                            <label class="custom-file-label" for="bukti">
                              <i class="fa-solid fa-arrow-up-from-bracket" style="padding-left: 10px; color:#595c5f;"></i>
                              <span id="fileName" class="file-name" style="padding-left: 20px; color:#595c5f;">Tidak ada file.</span>
                            </label>
                        </div>
                        <small class="text-danger" id="error-bukti" style="display: none;">Lengkapi file bukti pengeluaran.</small>
                    </div>
                    <div class="mb-3">
                        <p class="text-danger">*Wajib Diisi.</p>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn-kirim" onclick="submitPengeluaran()">Kirim</button>
                    </div>                     
                </form>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
     </section>
   
    <script>
        // SCRIPT UPLOAD FILE
        document.getElementById('bukti').addEventListener('change', function() {
            var fileName = this.files[0].name;
            document.getElementById('fileName').textContent = fileName;
        });

        // SCRIPT VALIDASI FORM DAN ALERT
        function submitPengeluaran() {
            // Ambil nilai dari setiap field
            var jenis = document.getElementById('jenis').value;
            var deskripsi = document.getElementById('deskripsi').value;
            var jumlah = document.getElementById('jumlah').value;
            var nominal = document.getElementById('nominal').value;
            var speedometer = document.getElementById('speedometer').value;
            var bukti = document.getElementById('bukti').value;

            // Flag validasi
            var isValid = true;

            // Reset error messages
            document.getElementById('error-jenis').style.display = 'none';
            document.getElementById('error-deskripsi').style.display = 'none';
            document.getElementById('error-jumlah').style.display = 'none';
            document.getElementById('error-nominal').style.display = 'none';
            document.getElementById('error-speedometer').style.display = 'none';
            document.getElementById('error-bukti').style.display = 'none';

            // Validasi Jenis Pengeluaran
            if (jenis === "") {
                document.getElementById('error-jenis').style.display = 'block';
                isValid = false;
            }

            // Validasi Deskripsi
            if (deskripsi === "") {
                document.getElementById('error-deskripsi').style.display = 'block';
                isValid = false;
            }

            // Validasi Jumlah
            if (jumlah === "") {
                document.getElementById('error-jumlah').style.display = 'block';
                isValid = false;
            }

            // Validasi Nominal
            if (nominal === "") {
                document.getElementById('error-nominal').style.display = 'block';
                isValid = false;
            }

            // Validasi Speedometer
            if (speedometer === "") {
                document.getElementById('error-speedometer').style.display = 'block';
                isValid = false;
            }

            // Validasi Bukti
            if (bukti === "") {
                document.getElementById('error-bukti').style.display = 'block';
                isValid = false;
            }

            // Jika semua field valid, tampilkan SweetAlert sukses
            if (isValid) {
                swal({
                    title: "Berhasil!",
                    text: "Data Pengeluaran berhasil dikirim.",
                    icon: "success",
                    button: true
                }).then(() => {
                    document.getElementById('formPengeluaran').reset(); // Reset form
                    // Reset displayed file name
                    document.getElementById('fileName').textContent = "Tidak ada file.";
                });
            } else {
                swal({
                    title: "Error!",
                    text: "Semua data harus diisi.",
                    icon: "error",
                    button: true
                });
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection