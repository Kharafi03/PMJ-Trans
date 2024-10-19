@extends('frontend.layouts.app')
@push('styles')
    <title>Trip History</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/riwayatDriver-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <section id="riwayatTrip">

        <!-- HEADER -->
        <div class="notrip-container container p-3">
            <x-header-driver />

            <!-- TEXT CONTENT -->
            <div class="text-content mb-3">
                <!-- <p>Riwayat On Trip Hari Ini ! </p> -->
                <!-- <p>Riwayat Trip {{ auth()->user()->name }}</p> -->
                <div class="text-content text-center mb-4">
                <h5 style="font-size: 25px; font-weight: 700; color: #1E9781;">RIWAYAT TRIP <span style="color: #FD9C07;">DRIVER</span></h5>
            </div>
            </div>

            <!-- RIWAYAT BUS -->
            <div class="riwayat-content accordion accordion-flush" id="item">
                @foreach ($trips as $index => $trip)
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item{{ $trip->id }}" aria-expanded="false">
                                <div class="riwayat-image">
                                    <img src="{{asset('img/pmj02-1.jpg')}}" class="img-fluid" width="60px" height="60px">
                                </div>
                                <div class="kode">
                                    <h5>{{ $trip->bus->name }}</h5>
                                    <p>{{ $trip->booking->booking_code }}</p>
                                </div>
                                <span class="ms-auto">
                                    <!-- <p>{{ \Carbon\Carbon::parse($trip->booking->date_start)->translatedFormat('d F \p\u\k\u\l H.i') }} -->
                                    <p>Hari ini, 07 Oktober 2024<br>Pukul 15.00</p>
                                </span>
                            </button>
                        </div>
                        <div id="item{{ $trip->id }}" class="accordion-collapse collapse" data-bs-parent="#item">
                            <div class="accordion-body">
                                <div class="detail-trip">
                                    <div class="tabel-detail d-flex align-items-center">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="keterangan">Status</td>
                                                    <td>
                                                        <div class="status">
                                                            {{ $trip->booking->ms_booking->name }}
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
                                                    <td class="keterangan ">Customer</td>
                                                    <td>{{ $trip->booking->customer->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="keterangan ">Nomor Telepon</td>
                                                    <td>{{ $trip->booking->customer->number_phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="keterangan ">Email</td>
                                                    <td>{{ $trip->booking->customer->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="keterangan ">Titik Jemput</td>
                                                    <td>{{ $trip->booking->pickup_point }}</td>
                                                </tr>
                                                @foreach ($destinations[$index] as $dest)
                                                    <tr>
                                                        <td class="keterangan ">Tujuan 
                                                            @if ($loop->last)
                                                                Akhir
                                                            @else
                                                                {{ $loop->iteration }}</td>
                                                            @endif
                                                        <td>{{ $dest->name }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="keterangan ">Kapasitas</td>
                                                    <td>{{ $trip->bus->capacity }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @foreach ($trip->tripbusspend as $spend)
                                    <div class="detail-pengeluaran">
                                        <div class="tabel-detail d-flex align-items-center">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">
                                                            Detail Pengeluaran Trip {{ $loop->iteration }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="keterangan">Nama Pengeluaran</td>
                                                        <td>{{ $spend->spend_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Deskripsi</td>
                                                        <td>{{ $spend->description }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Nominal</td>
                                                        <td>Rp {{ number_format($spend->nominal, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Kilometer Speedometer</td>
                                                        <td>{{ $spend->kilometer }} KM</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="keterangan ">Bukti Pengeluaran</td>
                                                        <td>
                                                            <button type="button"
                                                                onclick="modalBukti('{{ asset('storage/' . $spend->image_receipt) }}')"
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
                @endforeach
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
