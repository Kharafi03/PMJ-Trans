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
                            <div class="mb-4">
                                <label for="destination_point" class="form-label">Tujuan Akhir<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="destination_point" name="destination_point" placeholder="Masukkan tujuan perjalanan" required autofocus>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-location-dot"></i></span>
                                </div>
                            </div>
                            <!-- Kontainer Field Tujuan Tambahan -->
                            <div id="dynamic-fields"></div>

                            <!-- Tombol untuk Menambah Field -->
                            <button type="button" class="btn-tambahTujuan mb-4" id="add-field">Tambah Tujuan</button>

                            <div class="row">
                                <div class="col-md-8">
                                    <label for="capacity" class="form-label">Jumlah Penumpang<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="detail-pemesanan form-control" id="capacity" name="capacity" placeholder="Masukkan jumlah penumpang" required>
                                        <span class="input-group-text" id="icon"><i class="fa-solid fa-person"></i></span>
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

                               <!-- Tombol Tambah Leg Rest -->
                                <!-- <div class="mb-4" id="leg-rest-container">
                                    <button type="button" class="btn-legRest" id="add-leg-rest">Tambah Leg Rest</button>
                                </div> -->
                       
                            <div class="mb-4">
                                <label for="date_start" class="form-label">Tanggal Mulai<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="datetime-local" class="detail-pemesanan form-control" id="date_start" name="date_start" required>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="pickup_point" class="form-label">Titik Jemput<span class="text-danger">*</span></label>
                                <div>
                                    <textarea class="form-control" placeholder="Masukkan alamat lengkap" id="pickup_point" name="pickup_point" style="height: 100px;" required></textarea>
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
                                <label for="name" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-user"></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="number_phone" class="form-label">Nomor Telephone<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="detail-pemesanan form-control" id="number_phone" name="number_phone" placeholder="Masukkan nomor telepon aktif dan dapat dihubungi." required>
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-phone"></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" class="detail-pemesanan form-control" id="email" name="email" placeholder="Masukkan alamat email">
                                    <span class="input-group-text" id="icon"><i class="fa-solid fa-envelope"></i></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <div>
                                    <textarea class="form-control" placeholder="Alamat Lengkap" id="address" name="address" style="height: 100px" required></textarea>
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
    // let fieldCount = 1;

    // // Fungsi untuk menambah field baru
    // document.getElementById('add-field').addEventListener('click', function () {
    //     const dynamicFields = document.getElementById('dynamic-fields');
    //     const newField = document.createElement('div');
        
    //     newField.setAttribute('id', 'field-' + fieldCount);

    //     // Input field untuk tujuan tambahan
    //     newField.innerHTML = `
    //         <div class="input-group">
    //             <input type="text" class="form-control tujuan-input" placeholder="Tujuan Tambahan" name="tujuan[]" id="tujuan-${fieldCount}" required>
    //             <span class="input-group-text" id="icon"><i class="fa-solid fa-location-dot"></i></span>
    //         </div>
    //         <button type="button" class="btn btn-danger mt-2 mb-4" onclick="removeField(${fieldCount})">Hapus</button>
    //     `;

    //     dynamicFields.appendChild(newField);
    //     fieldCount++;

    //     // Nonaktifkan tombol tambah sampai field baru diisi
    //     toggleAddButton();
    // });

    // // Fungsi untuk mengaktifkan/menonaktifkan tombol tambah
    // function toggleAddButton() {
    //     const inputs = document.querySelectorAll('.tujuan-input');
    //     const addButton = document.getElementById('add-field');

    //     // Nonaktifkan tombol jika ada input yang kosong
    //     let allFilled = true;
    //     inputs.forEach(input => {
    //         if (!input.value) {
    //             allFilled = false;
    //         }
    //     });

    //     addButton.disabled = !allFilled;
    // }

    // // Tambahkan event listener ke input yang dibuat secara dinamis
    // document.addEventListener('input', function (event) {
    //     if (event.target && event.target.classList.contains('tujuan-input')) {
    //         toggleAddButton();
    //     }
    // });


    // // Remove field function
    // function removeField(id) {
    //     const field = document.getElementById('field-' + id);
    //     field.remove();
    // }

    // Counter untuk field yang ditambahkan secara dinamis
    let fieldCount = 0; // Inisialisasi ke 0

    // Fungsi untuk menambah field baru
    document.getElementById('add-field').addEventListener('click', function () {
        const dynamicFields = document.getElementById('dynamic-fields');

        // Menambahkan field baru
        const newField = document.createElement('div');
        fieldCount++; // Increment jumlah field

        newField.setAttribute('id', 'field-' + fieldCount);

        // Input field untuk tujuan tambahan
        newField.innerHTML = `
            <div class="mb-4">
                <label for="tujuan-${fieldCount}" class="form-label">Tujuan Akhir<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control tujuan-input" placeholder="Tujuan Akhir" name="tujuan[]" id="tujuan-${fieldCount}" required>
                    <span class="input-group-text" id="icon"><i class="fa-solid fa-location-dot"></i></span>
                </div>
            </div>
            <button type="button" class="btn-hapusTujuan btn btn-danger mb-4" onclick="removeField(${fieldCount})">Hapus</button>
        `;

        dynamicFields.appendChild(newField);

        // Nonaktifkan tombol tambah sampai field baru diisi
        toggleAddButton();
        // Perbarui label setelah menambah field
        updateLabels();
    });

    // Fungsi untuk mengaktifkan/menonaktifkan tombol tambah
    function toggleAddButton() {
        const inputs = document.querySelectorAll('.tujuan-input');
        const addButton = document.getElementById('add-field');

        // Nonaktifkan tombol jika ada input yang kosong
        let allFilled = true;
        inputs.forEach(input => {
            if (!input.value) {
                allFilled = false;
            }
        });

        addButton.disabled = !allFilled;
    }

    // Fungsi untuk memperbarui label tujuan
    function updateLabels() {
        const inputs = document.querySelectorAll('.tujuan-input');
        const firstLabel = document.querySelector('label[for="destination_point"]');

        // Update label untuk input pertama hanya jika ada field tambahan
        if (inputs.length > 0) {
            firstLabel.innerHTML = `Tujuan 1<span class="text-danger">*</span>`; // Label input awal

            // Update label untuk input tambahan
            inputs.forEach((input, index) => {
                const label = input.parentElement.previousElementSibling;

                // Perbarui label: yang terakhir menjadi "Tujuan Akhir", lainnya menjadi "Tujuan 2", "Tujuan 3", ...
                if (index === inputs.length - 1) {
                    label.innerHTML = 'Tujuan Akhir<span class="text-danger">*</span>';
                } else {
                    label.innerHTML = `Tujuan ${index + 2}<span class="text-danger">*</span>`; // Increment untuk tujuan tambahan
                }
            });
        } else {
            // Jika tidak ada input tambahan, kembalikan ke label default
            firstLabel.innerHTML = 'Tujuan Akhir<span class="text-danger">*</span>';
        }
    }

    // Tambahkan event listener ke input yang dibuat secara dinamis
    document.addEventListener('input', function (event) {
        if (event.target && event.target.classList.contains('tujuan-input')) {
            toggleAddButton();
        }
    });

    // Fungsi untuk menghapus field
    function removeField(id) {
        const field = document.getElementById('field-' + id);
        field.remove();
        fieldCount--; // Decrement jumlah field
        updateLabels(); // Perbarui label setelah menghapus field
        toggleAddButton(); // Periksa kembali apakah tombol tambah harus diaktifkan
    }

    // Inisialisasi field pertama dengan label
    updateLabels(); // Pastikan label benar dari awal


    // let debounceTimeout;

    // // Fungsi untuk memunculkan atau menyembunyikan tombol
    // function checkCapacity() {
    //     const capacityValue = parseInt(document.getElementById('capacity').value);

    //     // Tampilkan tombol jika jumlah penumpang <= 32 dan lebih dari 0
    //     if (capacityValue > 0 && capacityValue <= 32) {
    //         document.getElementById('leg-rest-container').style.display = 'block';
    //     } else {
    //         document.getElementById('leg-rest-container').style.display = 'none';
    //     }
    // }

    // // Debounce function untuk menghindari eksekusi cepat saat mengetik
    // function debounce(func, delay) {
    //     return function() {
    //         clearTimeout(debounceTimeout);
    //         debounceTimeout = setTimeout(func, delay);
    //     };
    // }

    // // Event listener dengan debounce
    // document.getElementById('capacity').addEventListener('input', debounce(checkCapacity, 500));

    // document.getElementById('add-leg-rest').addEventListener('click', function() {
    //     // Create a new div to contain the leg rest text and remove button
    //     const legRestDiv = document.createElement('div');
    //     legRestDiv.classList.add('mb-2', 'leg-rest-item');

    //     // Create the text for leg rest
    //     const legRestText = document.createElement('span');
    //     legRestText.innerText = 'Tambah Leg Rest ';
    //     legRestText.classList.add('me-2'); // Add margin to the right

    //     // Create the remove button (x icon)
    //     const removeButton = document.createElement('button');
    //     removeButton.type = 'button';
    //     removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'btn-x');
    //     removeButton.innerHTML = '&times;'; // Using HTML entity for multiplication sign (x)
    //     removeButton.addEventListener('click', function() {
    //         // Remove this leg rest item
    //         legRestDiv.remove();
    //         // Enable the add leg rest button again if there are no items left
    //         if (document.querySelectorAll('.leg-rest-item').length === 0) {
    //             document.getElementById('add-leg-rest').disabled = false; // Enable button again
    //         }
    //     });

    //     // Append text and button to the new div
    //     legRestDiv.appendChild(legRestText);
    //     legRestDiv.appendChild(removeButton);

    //     // Append the new div to the leg rests container
    //     document.getElementById('leg-rests').appendChild(legRestDiv);

    //     // Disable the add leg rest button after adding one
    //     this.disabled = true; // Disable button after adding
    // });

     // LEGREST
     // Ambil elemen switch dan placeholder untuk input leg rest
    const toggleLegRest = document.getElementById('toggle-leg-rest');
    const legRestsContainer = document.getElementById('leg-rests');

    // Tambahkan event listener untuk mengontrol input leg rest
    toggleLegRest.addEventListener('change', function () {
        if (this.checked) {
            // Jika switch diaktifkan, tambahkan input leg rest
            const legRestInput = `
                <div class="input-group">
                    <input type="text" class="form-control" id="leg-rest" name="leg_rest" placeholder="Masukkan detail leg rest" required>
                    <span class="input-group-text" id="icon"><i class="fa-solid fa-couch"></i></span>
                </div>
            `;
            legRestsContainer.innerHTML = legRestInput;
        } else {
            // Jika switch dimatikan, hapus input leg rest
            legRestsContainer.innerHTML = '';
        }
    });

    </script>
@endsection
