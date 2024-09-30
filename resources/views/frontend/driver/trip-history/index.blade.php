@extends('frontend.layouts.app')
@push('styles')
    <title>Trip History</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/riwayatPerjalanan-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <section id="riwayatTrip">

        <!-- HEADER -->
        <div class="notrip-container container p-3">
            <x-header-driver/>
            
            <!-- TEXT CONTENT -->
            <div class="text-content mb-3">
                <p>Riwayat Trip Nida</p>
            </div>

            <!-- RIWAYAT BUS -->
            <div class="accordion accordion-flush" id="item">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item1" aria-expanded="false">
                            <div class="kode">
                                <h5>PMJ 1</h5>
                                <p>PMJOKE12345</p>
                            </div>
                            <span class="ms-auto"><p>Hari ini, jam 12.30 WIB</p></span>
                        </button>
                    </div>
                    <div id="item1" class="accordion-collapse collapse" data-bs-parent="#item">
                        <div class="accordion-body">
                            <div class="detail-trip">
                                <div class="tabel-detail d-flex align-items-center">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="keterangan">Status</td>
                                                <td>
                                                    <div class="status">
                                                        Contact
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan">Tanggal</td>
                                                <td>
                                                    <div class="tgl">
                                                        21 september 2024
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Customer</td>
                                                <td >Nida Aulia Karima</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Nomor Telephone</td>
                                                <td >089876542232</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Email</td>
                                                <td >nida@gmail.com</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Titik Jemput</td>
                                                <td >Pekalongan</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Tujuan</td>
                                                <td >Itali</td>
                                            </tr>
                                            <tr></tr>
                                                <td class="keterangan ">Kapasitas</td>
                                                <td >40</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="detail-pengeluaran">
                                <!-- <div class="header-pengeluaran">
                                    <p>Detail Pengeluaran</p>
                                </div> -->
                                <div class="tabel-detail d-flex align-items-center">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    Detail Pengeluaran Trip 1
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="keterangan">Nama Pengeluaran</td>
                                                <td>Bensin</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Deskripsi</td>
                                                <td >Isi Bensin</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Jumlah</td>
                                                <td>1 Liter</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Nominal</td>
                                                <td >Rp 30.000</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Kilometer Speedometer</td>
                                                <td>1 KM</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Bukti Pengeluaran</td>
                                                <td >
                                                    <button type="button" onclick="modalBukti()" class="btn-bukti"><i class="fa-regular fa-eye"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item2" aria-expanded="false">
                            <div class="kode">
                                <h5>PMJ 2</h5>
                                <p>PMJOKE12345</p>
                            </div>
                            <span class="ms-auto"><p>11 Juni 2024, jam 12.30 WIB</p></span>
                        </button>
                    </div>
                    <div id="item2" class="accordion-collapse collapse" data-bs-parent="#item">
                        <div class="accordion-body">
                            <div class="detail-trip">
                                <div class="tabel-detail d-flex align-items-center">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="keterangan">Status</td>
                                                <td>
                                                    <div class="status">
                                                        Contact
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan">Tanggal</td>
                                                <td>
                                                    <div class="tgl">
                                                        21 september 2024
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Customer</td>
                                                <td >Nida Aulia Karima</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Nomor Telephone</td>
                                                <td >089876542232</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Email</td>
                                                <td >nida@gmail.com</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Titik Jemput</td>
                                                <td >Pekalongan</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Tujuan</td>
                                                <td >Itali</td>
                                            </tr>
                                            <tr></tr>
                                                <td class="keterangan ">Kapasitas</td>
                                                <td >40</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="detail-pengeluaran">
                                <!-- <div class="header-pengeluaran">
                                    <p>Detail Pengeluaran</p>
                                </div> -->
                                <div class="tabel-detail d-flex align-items-center">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    Detail Pengeluaran Trip 1
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="keterangan">Nama Pengeluaran</td>
                                                <td>Bensin</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Deskripsi</td>
                                                <td >Isi Bensin</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Jumlah</td>
                                                <td>1 Liter</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Nominal</td>
                                                <td >Rp 30.000</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Kilometer Speedometer</td>
                                                <td>1 KM</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Bukti Pengeluaran</td>
                                                <td >
                                                    <button type="button" onclick="modalBukti()" class="btn-bukti"><i class="fa-regular fa-eye"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="detail-pengeluaran">
                                <!-- <div class="header-pengeluaran">
                                    <p>Detail Pengeluaran</p>
                                </div> -->
                                <div class="tabel-detail d-flex align-items-center">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    Detail Pengeluaran Trip 2
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="keterangan">Nama Pengeluaran</td>
                                                <td>Bensin</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Deskripsi</td>
                                                <td >Isi Bensin</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Jumlah</td>
                                                <td>1 Liter</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Nominal</td>
                                                <td >Rp 30.000</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Kilometer Speedometer</td>
                                                <td>1 KM</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Bukti Pengeluaran</td>
                                                <td >
                                                    <button type="button" onclick="modalBukti()" class="btn-bukti"><i class="fa-regular fa-eye"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL BUKTI -->
            <div class="modal fade" id="modalBukti" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><img src="img/close.png"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Bukti Pengeluaran</h5>
                            <img src="img/bukti1.png" class="img-fluid" alt="Gambar Bukti Pengeluaran">
                        </div>
                    </div>
                </div>
            </div>

            
            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>

    <script>
        //MODAL
        function modalBukti() {
            var myModal = new bootstrap.Modal(document.getElementById('modalBukti'));
            myModal.show();
        };
    </script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection