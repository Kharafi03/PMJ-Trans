@extends('frontend.layouts.app')
@push('styles')
    <title>Detail Trip</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/dashboardDetail-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <section id="dashboardDetail">
        <div class="dashboard-container container p-3">

            <div class="text-content text-start mb-4">
                <div class="row">
                    <div class="col-2" style="margin-right: -20px;">
                        <a href="{{ route('dashboard-driver') }}"><i class="fa-solid fa-chevron-left"></i></a>
                    </div>
                    <div class="col-10">
                        <h5 style="font-size: 20px; font-weight: 700; color: #1E9781;">Detail <span style="color: #FD9C07;">Trip</span></h5>
                        <p class="caption">Berikut adalah detail trip anda.</p>
                    </div>
                </div>
            </div>

            <!-- CARD -->
            <div class="detail mb-5">
                <div class="detail-sewa mb-5">
                    <div class="tabel-detail d-flex align-items-center">
                        <table class="table table-borderless">
                            <thead>
                                <tr style="padding: 10px;">
                                    <th colspan="2" style="background-color:#E42E07;">
                                        {{--<h5 style="color: white;">{{ $trip->booking->booking_code }}</h5>--}}
                                        <div class="header d-flex align-items-center">
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
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="keterangan">Driver</td>
                                    <td>
                                        {{ $trip->driver->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="keterangan">Co Driver</td>
                                    <td>
                                        {{ $trip->codriver->name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="keterangan">Jenis Armada</td>
                                    <td>{{ $trip->bus->name }}</td>
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
                                @foreach ($destination as $dest)
                                    <tr>
                                        <td class="keterangan">
                                            @if ($destination->count() === 1 || $loop->last)
                                                Tujuan Akhir
                                            @else
                                                Tujuan {{ $loop->iteration }}
                                            @endif
                                        </td>
                                        <td>{{ $dest->name }}</td>
                                    </tr>
                                @endforeach

                                {{-- <tr>
                                    <td class="keterangan ">Tujuan Akhir</td>
                                    <td>{{ $trip->booking->destination_point }}</td>
                                </tr> --}}
                                <tr>
                                    <td class="keterangan ">Jumlah Penumpang</td>
                                    <td>{{ $trip->booking->capacity }}</td>
                                </tr>
                                <tr>
                                    <td class="keterangan ">Status</td>
                                    <td>{{ $trip->booking->ms_booking->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- NAVBAR -->
            <x-navbar-driver />
        </div>
    </section>
@endsection
