@extends('frontend.layouts.app')
@push('styles')
    <title>Input Data</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/endTrip-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- CONTENT -->
    <section id="dashboardEnd">
        <div class="dashboard-container container p-3">
            <div class="text-content text-start mb-4">
                <div class="row">
                    <div class="col-2" style="margin-right: -20px;">
                        <a href="{{ route('dashboard-trip') }}"><i class="fa-solid fa-chevron-left"></i></a>
                    </div>
                    <div class="col-10">
                        <h5 style="font-size: 20px; font-weight: 700; color: #1E9781;">Akhiri <span style="color: #FD9C07;">Trip</span></h5>
                        <p class="caption">Masukkan data saat trip selesai</p>
                    </div>
                </div>
            </div>

            <!-- FORM INPUT -->
            <div class="form-km p-3 mb-5 mt-5">
                <form id="formEndTrip" action="{{ route('km-end', $trip->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="km_end" class="form-label">Kilometer Akhir<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="icon"><i class="fa-solid fa-road-bridge"></i></span>
                            <input type="text" class="form-control" id="km_end" name="km_end" placeholder="Masukkan Kilometer Akhir" required>
                        </div>
                        <small class="text-danger" id="error" style="display: none;">Data harus diisi.</small>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn-endtrip">Kirim</button>
                    </div>
                </form>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>

    <!-- SCRIPT -->
    @push('scripts')
        <script>
            // Fungsi untuk memformat input dengan pemisah ribuan
            function formatInput(inputElement) {
                $(inputElement).on('input', function() {
                    let inputVal = $(this).val();
                    
                    // Hilangkan karakter selain angka
                    inputVal = inputVal.replace(/[^\d]/g, '');
                    
                    // Format dengan pemisah ribuan (setiap 3 digit)
                    inputVal = inputVal.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    
                    // Set kembali nilai input dengan pemisah ribuan
                    $(this).val(inputVal);
                });
            }

            $(document).ready(function () {
                // Terapkan format untuk kedua input: #nominal dan #kilometer
                formatInput('#km_end');

                // Sebelum formulir dikirim, hapus titik untuk mengirim data dalam format angka murni
                $('#formEndTrip').on('submit', function(e) {

                    e.preventDefault();

                     // Ambil nilai dari input
                    let km_end = $('#km_end').val();
                    
                    // Hapus titik untuk mendapatkan angka murni (juga menghapus koma jika ada)
                    km_end = km_end.replace(/\./g, ''); // Menghapus titik

                    // Set nilai input km_end yang akan dikirim tanpa titik
                    $('#km_end').val(km_end);

                    // Kirim formulir
                    $(this).unbind('submit').submit();
                });
            });
        </script>
    @endpush

@endsection
