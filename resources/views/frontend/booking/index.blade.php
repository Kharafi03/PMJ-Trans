@extends('frontend.layouts.app')
@push('styles')
    <title>Booking</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesanan-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- CONTENT -->
    <!-- TITLE -->
    <section id="pemesanan">
        <div class="container mt-5">
            <h5><b>PEMESANAN</b></h5>
            <p class="caption">Pilih jadwal, destinasi, serta tipe kendaraan yang sesuai dengan kebutuhan Anda. Rasakan
                pengalaman perjalanan yang nyaman bersama layanan PMJ Trans</p>
        </div>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <li class="text-white">{{ $error }}</li>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- FORM -->
    <section id="form">
        <div class="container">
            <form id="formPemesanan" action="{{ route('booking.store') }} " method="POST">
                @csrf
                <div class="row form-container">
                    <div class="col-lg-6" style="padding: 40px;">
                        <div class="text-content">
                            <h5><b>Detail Pemesanan</b></h5>
                            <p class="caption">Silahkan isi formulir detail pemesanan di bawah ini untuk melakukan pemesanan
                            </p>
                        </div>
                        <div class="row">
                            <!-- Kontainer Field Tujuan Tambahan -->
                            <div id="dynamic-fields">
                                <!-- Input pertama sebagai "Tujuan Akhir" -->
                                <div id="destination-point-field">
                                    <div class="mb-4">
                                        <label for="destination_point" class="form-label">Tujuan Akhir<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control tujuan-input"
                                                placeholder="Tujuan Akhir" name="tujuan[]" id="destination_point" required>
                                            <span class="input-group-text" id="icon"><i
                                                    class="fa-solid fa-location-dot"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="mb-4">
                                <label for="destination_point" class="form-label">Tujuan Akhir<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="destination_point"
                                        name="destination_point" placeholder="Masukkan tujuan perjalanan" required
                                        autofocus>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-location-dot"></i></span>
                                </div>
                            </div> --}}
                            <!-- Tombol untuk Menambah Field -->
                            <button type="button" class="btn-tambahTujuan mb-4" id="add-field">Tambah Tujuan</button>

                            <div class="row">
                                <div class="col-md-8">
                                    <label for="capacity" class="form-label">Jumlah Penumpang<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="detail-pemesanan form-control" id="capacity"
                                            name="capacity" placeholder="Masukkan jumlah penumpang" min="1" required>
                                        <span class="input-group-text" id="icon"><i
                                                class="fa-solid fa-person"></i></span>
                                    </div>
                                    <!-- Placeholder for dynamically added leg rest -->
                                    <!-- <div id="leg-rests" class="mt-2 mb-2"></div> -->
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <!-- Switch untuk menampilkan/menghilangkan input leg rest -->
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="toggle-leg-rest">
                                        <label class="form-check-label" for="toggle-leg-rest">Leg Rest</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Placeholder for dynamically added leg rest input -->
                            <div id="leg-rests" class="mb-4"></div>
                            <input type="hidden" name="legrest" value="0">

                            <!-- Tombol Tambah Leg Rest -->
                            <!-- <div class="mb-4" id="leg-rest-container">
                                                                                            <button type="button" class="btn-legRest" id="add-leg-rest">Tambah Leg Rest</button>
                                                                                        </div> -->

                            <div class="mb-4">
                                <label for="date_start" class="form-label">Tanggal Mulai<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="datetime-local" class="detail-pemesanan form-control" id="date_start"
                                        name="date_start" min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d\TH:i') }}"
                                        required>

                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="pickup_point" class="form-label">Titik Jemput<span
                                        class="text-danger">*</span></label>
                                <div>
                                    <textarea class="form-control" placeholder="Masukkan alamat lengkap" id="pickup_point" name="pickup_point"
                                        style="height: 100px;" required></textarea>
                                </div>
                            </div>
                            <div>
                                <p class="text-danger" style="font-size:18px;">*Wajib Diisi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" style="padding: 40px;">
                        <div class="text-content">
                            <h5><b>Detail Kontak</b></h5>
                            <p class="caption">Silahkan lengkapi formulir detail kontak di bawah ini untuk melakukan
                                pemesanan</p>
                        </div>
                        <div class="row">
                            <div class="mb-4">
                                <label for="name" class="form-label">Nama Lengkap<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="name"
                                        name="name" placeholder="Masukkan nama lengkap" required
                                        @if (Auth::check()) value="{{ Auth::user()->name }}" readonly @endif>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-user"></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="number_phone" class="form-label">Nomor Telephone<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="detail-pemesanan form-control" id="number_phone"
                                        name="number_phone"
                                        placeholder="Masukkan nomor telepon aktif dan dapat dihubungi." required
                                        @if (Auth::check()) value="{{ Auth::user()->number_phone }}" readonly @endif>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-phone"></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" class="detail-pemesanan form-control" id="email"
                                        name="email" placeholder="Masukkan alamat email"
                                        @if (Auth::check() && Auth::user()->email) value="{{ Auth::user()->email }}" readonly @endif>
                                    <span class="input-group-text" id="icon"><i
                                            class="fa-solid fa-envelope"></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <div>
                                    <textarea class="form-control" placeholder="Alamat Lengkap" id="address" name="address" style="height: 100px"
                                        @if (Auth::check()) readonly @endif>{{ Auth::check() ? Auth::user()->address : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-end">
                    <button type="submit" class="btn-pemesanan">Kirim</button>
                </div>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <x-footer-customer />


    <!-- SCRIPT -->

    <script>
        // Counter untuk field yang ditambahkan secara dinamis
        let fieldCount = 0; // Inisialisasi ke 0

        // Fungsi untuk menonaktifkan atau mengaktifkan tombol
        function toggleAddButton() {
            const inputs = document.querySelectorAll('.tujuan-input');

            // Periksa apakah semua input terisi
            let allFilled = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    allFilled = false;
                }
            });

            // Aktifkan tombol hanya jika semua input terisi
            document.getElementById('add-field').disabled = !allFilled;
        }

        // Event listener untuk menambah field tujuan baru
        document.getElementById('add-field').addEventListener('click', function() {
            const dynamicFields = document.getElementById('dynamic-fields');
            const destinationPointField = document.getElementById('destination-point-field');

            // Menambahkan field baru
            fieldCount++; // Increment jumlah field
            const newField = document.createElement('div');
            newField.setAttribute('id', 'field-' + fieldCount);

            newField.innerHTML = `
            <div class="mb-4">
                <label for="tujuan-${fieldCount}" class="form-label">Tujuan ${fieldCount}<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control tujuan-input" placeholder="Tujuan ${fieldCount}" name="tujuan[]" id="tujuan-${fieldCount}" required>
                    <span class="input-group-text" id="icon"><i class="fa-solid fa-location-dot"></i></span>
                </div>
            </div>
            <button type="button" class="btn-hapusTujuan btn btn-danger mb-4" onclick="removeField(${fieldCount})">Hapus</button>
        `;

            // Tambahkan field baru sebelum tujuan akhir
            dynamicFields.insertBefore(newField, destinationPointField);

            // Setelah menambah field, periksa input terakhir
            toggleAddButton();
            updateLabels(); // Perbarui label setelah menambah field
        });

        // Event listener untuk setiap input tujuan
        document.addEventListener('input', function(e) {
            if (e.target.matches('.tujuan-input')) {
                toggleAddButton(); // Periksa apakah semua input sudah terisi
            }
        });

        // Fungsi untuk memperbarui label tujuan
        function updateLabels() {
            const inputs = document.querySelectorAll('.tujuan-input');
            const firstLabel = document.querySelector('label[for="destination_point"]');

            // Jika ada field tambahan, ubah label pertama menjadi "Tujuan 1"
            if (inputs.length > 0) {
                inputs.forEach((input, index) => {
                    const label = input.parentElement.previousElementSibling;
                    label.innerHTML = `Tujuan ${index + 1}<span class="text-danger">*</span>`;
                });

                // Tetap pertahankan label "Tujuan Akhir" untuk input terakhir
                firstLabel.innerHTML = 'Tujuan Akhir<span class="text-danger">*</span>';
            } else {
                // Jika tidak ada tujuan tambahan, kembalikan ke label default "Tujuan Akhir"
                firstLabel.innerHTML = 'Tujuan Akhir<span class="text-danger">*</span>';
            }
        }

        // Fungsi untuk menghapus field
        function removeField(id) {
            const field = document.getElementById('field-' + id);
            field.remove();
            fieldCount--; // Decrement jumlah field
            updateLabels(); // Perbarui label setelah menghapus field
            toggleAddButton(); // Periksa kembali apakah tombol tambah harus diaktifkan
        }

        // Inisialisasi untuk pertama kali
        toggleAddButton(); // Cek tombol tambah awal
        updateLabels(); // Pastikan label benar dari awal
    </script>
    <script>
        // LEGREST
        // Ambil elemen switch dan placeholder untuk input leg rest
        const toggleLegRest = document.getElementById('toggle-leg-rest');
        const legRestsContainer = document.getElementById('leg-rests');
        const hiddenLegRestInput = document.querySelector('input[name="legrest"]'); // Ambil input hidden legrest

        // Tambahkan event listener untuk mengontrol input leg rest
        toggleLegRest.addEventListener('change', function() {
            if (this.checked) {
                // Jika switch diaktifkan, tambahkan input leg rest hanya jika belum ada
                hiddenLegRestInput.value = 1; // Mengubah nilai hidden field menjadi 1

                if (!document.getElementById('legrest')) {
                    const legRestInput = `
            <div class="input-group">
                <input type="text" class="form-control" id="description" name="description" placeholder="Masukkan detail leg rest">
                <span class="input-group-text" id="icon"><i class="fa-solid fa-couch"></i></span>
            </div>
            `;
                    legRestsContainer.innerHTML = legRestInput; // Menambahkan input leg rest
                }
            } else {
                // Jika switch dimatikan, hapus input leg rest
                legRestsContainer.innerHTML = ''; // Menghapus input leg rest
            }
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
