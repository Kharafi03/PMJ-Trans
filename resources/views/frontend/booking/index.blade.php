@extends('frontend.layouts.app')
@push('styles')
    <title>Booking</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/pemesanan-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

    <!-- BREADCRUMBS -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-center align-items-center">
            <li class="breadcrumb-item"><a href="{{route('homepage')}}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Formulir Pemesanan</li>
        </ol>
    </nav>

    <!-- CONTENT -->
    <!-- TITLE -->
    <section id="pemesanan">
        <div class="container mt-5 mb-5">
            <h5 style="font-size: 44px; font-weight: 700; color: #1E9781;">FORMULIR <span style="color: #FD9C07;">PEMESANAN</span></h5>
            <p style="font-size: 18px; font-weight: 600; color: #666666B5;">Pilih jadwal, destinasi, serta tipe kendaraan yang sesuai dengan kebutuhan Anda. Rasakan pengalaman perjalanan yang nyaman bersama layanan PMJ Trans</p> 
            <div class="info">
                <p class="info-title"><i class="fa-solid fa-circle-exclamation"></i> Informasi Pemesanan</p>
                <ul>
                    <li>Simbol <span style="font-weight: 700; color: #F44C28;">( * )</span> menandakan forumilir wajib diiisi</li>
                    <li>Masukan “Tujuan Akhir” terlebih dahulu, jika ingin menambah tujuan, klik botton “ + Tujuan” , kemudian masukan tujuan 1,2, dst.</li>
                    <li>1 unit bus = 32 penumpang. </li>
                    <li>Leg Rest adalah sandaran kaki. Kursi ini mampu meningkatkan rasa nyaman para penumpang yang ingin beristirahat selama perjalanan jauh.</li>
                    <li>Masukan “Titik Jemput dengan format :  Nama jalan, No Rumah (opsional), RT/RW, Kelurahan, Kecamatan, dan Kabupaten.</li>
                </ul>
            </div>
        </div>


    <!-- FORM -->
        <div class="container">
            @include('frontend.assets.alert')
            <form id="formPemesanan" action="{{ route('booking.store') }} " method="POST">
                @csrf
                <div class="row form-container">
                    <div class="col-lg-7" style="padding: 40px;">
                        <div class="text-content">
                            <h5 style="font-size: 30px; font-weight: 700; color: #1E9781;">Detail <span style="color: #FD9C07;">Pemesanan</span></h5>
                            <p style="font-size: 16px; font-weight: 500; color: #666666B5;">Silahkan isi formulir detail pemesanan di bawah ini untuk melakukan pemesanan</p>
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
                                            <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-tujuan.png') }}" alt="icon"></span>
                                            <input type="text" class="form-control tujuan-input @error('destination_point') is-invalid @enderror"
                                            placeholder="Masukkan nama dan kota tujuan (contoh: Malioboro, Yogyakarta)" name="tujuan[]" id="destination_point" required>
                                            @error('destination_point')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="mb-4">
                                <label for="destination_point" class="form-label">Tujuan Akhir<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-tujuan.png') }}" alt="icon"></span>
                                    <input type="text" class="detail-pemesanan form-control" id="destination_point"
                                        name="destination_point" placeholder="Masukkan tujuan perjalanan" required>
                                </div>
                            </div> --}}
                            <!-- Tombol untuk Menambah Field -->
                            <button type="button" class="btn-tambahTujuan mb-4" id="add-field"><i class="fa-solid fa-plus"></i> Tambah Tujuan</button>

                            <div class="row">
                                <div class="col-md-9">
                                    <label for="capacity" class="form-label">Jumlah Penumpang<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-penumpang.png') }}" alt="icon"></span>
                                        <input type="number" class="detail-pemesanan form-control @error('capacity') is-invalid @enderror" id="capacity"
                                            name="capacity" placeholder="Masukkan jumlah penumpang" min="1" required>
                                        @error('capacity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- Placeholder for dynamically added leg rest -->
                                    <!-- <div id="leg-rests" class="mt-2 mb-2"></div> -->
                                </div>
                                <div class="col-md-3 d-flex align-items-center">
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

                            <div class="mb-4">
                                <label for="date_start" class="form-label">Tanggal Mulai<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-kalender1.png') }}" alt="icon"></span>
                                    <input type="datetime-local" class="detail-pemesanan form-control @error('date_start') is-invalid @enderror" id="date_start"
                                        name="date_start" min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d\TH:i') }}"
                                        required>
                                    @error('date_start')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="pickup_point" class="form-label @error('pickup_point') is-invalid @enderror">Titik Jemput<span
                                        class="text-danger">*</span></label>
                                    <textarea class="form-control" placeholder="Masukkan alamat lengkap" id="pickup_point" name="pickup_point"
                                        style="height: 100px;" required></textarea>
                                    @error('pickup_point')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div>
                                <p class="text-danger" style="font-size:14px;">Contoh : Jalan Mangga Besar III No. 17, RT 06 RW 07, Kelurahan Bedali, Kecamatan Lawang, Kab. Malang, Jawa Timur, 60256</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5" style="padding: 40px;">
                        <div class="text-content">
                            <h5 style="font-size: 30px; font-weight: 700; color: #1E9781;">Detail <span style="color: #FD9C07;">Kontak</span></h5>
                            <p style="font-size: 16px; font-weight: 500; color: #666666B5;">Silahkan lengkapi formulir detail kontak di bawah ini untuk melakukan pemesanan</p>
                        </div>
                        <div class="row">
                            <div class="mb-4">
                                <label for="name" class="form-label">Nama Lengkap<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-user.png') }}" alt="icon"></span>
                                    <input type="text" class="detail-pemesanan form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" placeholder="Masukkan nama lengkap" required
                                        @if (Auth::check()) value="{{ Auth::user()->name }}" readonly @endif>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="number_phone" class="form-label">Nomor WhatsApp<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-wa.png') }}" alt="icon"></span>
                                    <input type="number" class="detail-pemesanan form-control @error('number_phone') is-invalid @enderror" id="number_phone"
                                        name="number_phone"
                                        placeholder="Masukkan nomor whatsapp" required
                                        @if (Auth::check()) value="{{ Auth::user()->number_phone }}" readonly @endif>
                                    @error('number_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-email.png') }}" alt="icon"></span>
                                    <input type="email" class="detail-pemesanan form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" placeholder="Masukkan alamat email"
                                        @if (Auth::check() && Auth::user()->email) value="{{ Auth::user()->email }}" readonly @endif>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <div>
                                    <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Alamat Lengkap" id="address" name="address" style="height: 100px"
                                        @if (Auth::check()) readonly @endif>{{ Auth::check() ? Auth::user()->address : '' }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container d-flex justify-content-end">
                        <button type="submit" class="btn-pemesanan">Kirim</button>
                    </div>
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
                    <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-tujuan.png') }}" alt="icon"></span>
                    <input type="text" class="form-control tujuan-input" placeholder="Tujuan ${fieldCount}" name="tujuan[]" id="tujuan-${fieldCount}" required>
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
                <span class="input-group-text" id="icon"><img src="{{ asset('img/icon/icon-legrest.png') }}" alt="icon"></span>
                <input type="text" class="form-control" id="description" name="description" placeholder="Masukkan detail leg rest">
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
