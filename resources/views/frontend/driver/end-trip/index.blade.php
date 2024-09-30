@extends('frontend.layouts.app')
@push('styles')
    <title>Input Data</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/endTrip-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardEnd">
        <div class="dashboard-container container p-3">
            <!-- HEADER -->
            <x-header-driver />
            <!-- TEXT CONTENT -->
            <div class="text-content text-center">
                <p class="title">DATA PERJALANAN</p>
            </div>
            <!-- BUTTON -->
            <div class="p-3 mb-4">
                <div class="mb-3" >
                <button class="btn-end"  disabled>
                    <div class="btn-container">
                        <div class="icon">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <div class="text">
                            <h6>Akhiri Trip</h6>
                            <p>Masukan data saat trip selesai</p>
                        </div>
                    </div>
                </button>
                </div>              
            </div>
            <!-- FORM INPUT -->
            <div class="form-km p-3 mb-5">
                <form id="formEndTrip">
                    <div class="mb-3">
                        <label for="endTrip" class="form-label">Kilometer Akhir<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-gauge"></i></span>                      
                            <input type="text" class="form-control" id="endTrip" placeholder="Masukkan Kilometer Akhir" required autofocus>
                        </div>
                        <small class="text-danger" id="error" style="display: none;">Data harus diisi.</small>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn-endtrip" onclick="submitEndTrip()">Kirim</button>
                    </div>                     
                </form>
            </div>
            
            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
     </section>

     <script>
        //SCRIPT ALERT
        function submitEndTrip() {
            //Ambil nilai field
            var endTrip = document.getElementById('endTrip').value;

            //Validasi
            var isValid = true;

            // Pesan eror
            document.getElementById('error').style.display = 'none';

            // Validasi inputan
            if (endTrip === "") {
                document.getElementById('error').style.display = 'block';
                isValid = false;
            }
            if(isValid){
            swal({
                title: "Berhasil!",
                text: "Data berhasil dikirim.",
                icon: "success",
                button: true
            }).then(()=>{
                window.location.href = "{{ route('dashboard-driver') }}";
            });
            }else{
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