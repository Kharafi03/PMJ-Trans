@extends('frontend.layouts.app')
@push('styles')
    <title>Trip History</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/riwayatPerjalanan-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <section id="riwayatTrip">

        <!-- HEADER -->
        <div class="notrip-container container p-3">
            <!-- <x-header-driver /> -->

            <!-- TEXT CONTENT -->
            <!-- <div class="text-content mb-3"> -->
                <!-- <p>Riwayat On Trip Hari Ini ! </p> -->
                <!-- <p>Riwayat On Trip {{ auth()->user()->name }} Hari Ini !</p>
            </div> -->

            <div class="text-content text-start mb-4">
                <!-- <h5 style="font-size: 25px; font-weight: 700; color: #1E9781;">Scan QR Code <span style="color: #FD9C07;">Driver</span></h5>
                <p class="caption">Silahkan Scan QR-Code diatas untuk memulai trip</p> -->
                <div class="row">
                    <div class="col-2" style="margin-right: -20px;">
                        <a href="{{ route('dashboard-trip') }}"><i class="fa-solid fa-chevron-left"></i></a>
                    </div>
                    <div class="col-10">
                        <h5 style="font-size: 20px; font-weight: 700; color: #1E9781;">Riwayat <span style="color: #FD9C07;">On Trip</span></h5>
                        <p class="caption">Riwayat Trip sedang berlangsung</p>
                    </div>
                </div>
            </div>

            <!-- RIWAYAT BUS -->
            <div class="accordion accordion-flush" id="item">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item2" aria-expanded="false">
                            <div class="riwayat-image">
                                <img src="{{ asset('storage/' . $trip->bus->images->first()->image) }}" class="img-fluid" width="60" height="60">
                            </div>
                            <div class="kode">
                                <h5>{{ $trip->bus->name }}</h5>
                                <p>{{ $trip->booking->booking_code }}</p>
                            </div>
                            <span class="ms-auto">
                                <p class="mb-0">{{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F Y') }}</p>
                                <p class="mb-0">Pukul {{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('H.i') }}</p>
                            </span>
                        </button>
                    </div>
                    <div id="item2" class="accordion-collapse collapse show" data-bs-parent="#item">
                        <div class="accordion-body">
                            <div class="detail-trip">
                                <div class="tabel-detail d-flex align-items-center">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="keterangan">Status</td>
                                                <td>
                                                    <div class="status">
                                                        {{ $trip->ms_trip->name }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan">Tanggal</td>
                                                <td>
                                                    <div class="tgl">
                                                        {{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F Y') }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Total Pengeluaran</td>
                                                <td>
                                                    <div class="total">
                                                        Rp {{ number_format($trip->total_spend, 0, ',', '.') }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Sisa Uang Jalan</td>
                                                <td>
                                                    <div class="saldo">
                                                        Rp {{ number_format($trip->nominal, 0, ',', '.') }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Customer</td>
                                                <td>{{ $trip->booking->customer->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Nomor Telepon</td>
                                                <td>{{ $trip->booking->customer->number_phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="keterangan ">Titik Jemput</td>
                                                <td>{{ $trip->booking->pickup_point }}</td>
                                            </tr>
                                            @foreach ($destinations as $dest)
                                                <tr>
                                                    <td class="keterangan ">Tujuan
                                                        @if ($loop->last)
                                                            Akhir
                                                        @else
                                                            {{ $loop->iteration }}
                                                    </td>
                                            @endif
                                            <td>{{ $dest->name }}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td class="keterangan ">Kapasitas</td>
                                                <td>{{ $trip->booking->capacity }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @foreach ($tripspends as $tripspend)
                                <div class="detail-pengeluaran">
                                    <div class="tabel-detail d-flex align-items-center">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        Detail Pengeluaran ke {{ $loop->iteration }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="keterangan">Nama Pengeluaran</td>
                                                    <td>{{ $tripspend->mspend->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="keterangan ">Deskripsi</td>
                                                    <td>{{ $tripspend->description }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="keterangan ">Nominal</td>
                                                    <td>Rp {{ number_format($tripspend->nominal, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="keterangan ">Kilometer Speedometer</td>
                                                    <td>{{ $tripspend->kilometer }} KM</td>
                                                </tr>
                                                <tr>
                                                    <td class="keterangan ">Bukti Pengeluaran</td>
                                                    <td>
                                                        <button type="button"
                                                            onclick="modalBukti('{{ asset('storage/' . $tripspend->image_receipt) }}')"
                                                            class="btn-bukti">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </button>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL BUKTI -->
            <div class="modal fade" id="modalBukti" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="fa fa-times"></i></button>
                        </div>
                        <div class="modal-body">
                            <h5>Bukti Pengeluaran</h5>
                            <img id="modalImage" src="" class="img-fluid" alt="Gambar Bukti Pengeluaran">
                        </div>
                    </div>
                </div>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>

    <script>
        function modalBukti(imageReceiptUrl) {
            var myModal = new bootstrap.Modal(document.getElementById('modalBukti'));
            document.getElementById('modalImage').src = imageReceiptUrl;
            myModal.show();
        }
    </script>
@endsection
