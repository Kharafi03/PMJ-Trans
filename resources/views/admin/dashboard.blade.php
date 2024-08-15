@extends('admin.layout.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card card-information d-flex h-100">
                    <div class="card-body d-flex flex-column p-3">
                        <div class="row">
                            <div class="col-8 d-flex flex-column justify-content-between">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                        Total Bus
                                    </p>
                                    <h4 class="font-weight-bolder">3</h4>
                                </div>
                            </div>
                            <div class="col-4 position-absolute end-0">
                                <div
                                    class="icon icon-shape bg-gradient-secondary shadow-primary text-center rounded-circle">
                                    <i class="fa-solid fa-hourglass-start text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="mb-0">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold"></span>
                                dibandingkan minggu lalu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card card-information d-flex h-100">
                    <div class="card-body d-flex flex-column p-3">
                        <div class="row">
                            <div class="col-8 d-flex flex-column justify-content-between">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                        Total Driver
                                    </p>
                                    <h4 class="font-weight-bolder">3</h4>
                                </div>
                            </div>
                            <div class="col-4 position-absolute end-0">
                                <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle">
                                    <i class="fa-solid fa-check-circle text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="mb-0">
                                <i
                                    class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold"></span>
                                dibandingkan minggu lalu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card card-information d-flex h-100">
                    <div class="card-body d-flex flex-column p-3">
                        <div class="row">
                            <div class="col-8 d-flex flex-column justify-content-between">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                        Total Customer
                                    </p>
                                    <h4 class="font-weight-bolder">3</h4>
                                </div>
                            </div>
                            <div class="col-4 position-absolute end-0">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fa-solid fa-window-restore text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="mb-0">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold"></span>
                                dibandingkan minggu lalu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card d-flex h-100">
                    <div class="card-body d-flex flex-column p-3">
                        <div class="row">
                            <div class="col-8 d-flex flex-column justify-content-between">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                        Total Trip Hari Ini
                                    </p>
                                    <h4 class="font-weight-bolder">3</h4>
                                </div>
                            </div>
                            <div class="col-4 position-absolute end-0">
                                <div class="icon icon-shape bg-gradient-dark shadow-primary text-center rounded-circle">
                                    <i class="fa-solid fa-gauge  text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="mb-0">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">
                                </span>
                                dibandingkan minggu lalu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h4 class="text-capitalize">Total Pendapatan</h4>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">
                            </span> dibandingkan bulan lalu
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-income" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active"
                                style="background-image: url('https://images.unsplash.com/photo-1605756580041-21312e9fb2bc?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <h5 class="text-white mb-1">OtoRent | Ankavi Team</h5>
                                    <p>
                                        Tempat Persewaan Mobil dan Motor Nyaman, Aman dan Percaya !
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item h-100"
                                style="background-image: url('https://images.unsplash.com/photo-1682020245785-4619e7a89d2f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <h5 class="text-white mb-1">
                                        Persewaan Mobil dan Motor
                                    </h5>
                                    <p>
                                        Nikmati perjalanan anda dengan armada terbaik dari kami !
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item h-100"
                                style="background-image: url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bW90b3JjeWNsZXxlbnwwfHwwfHx8MA%3D%3D'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <h5 class="text-white mb-1">
                                        Persewaan Mobil dan Motor
                                    </h5>
                                    <p>
                                        Tunggu apalagi? Sewa Sekarang juga !
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Sewa Terbaru</h6>
                        </div>
                    </div>
                    <div class="table-responsive p-4">
                        <table id="data-table" class="table table-hover text-nowrap text-center align-middle w-100">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder">
                                        Nama
                                    </th>
                                    <th class="text-uppercase text-xs font-weight-bolder">
                                        Unit
                                    </th>
                                    <th class="text-uppercase text-xs font-weight-bolder">
                                        Durasi
                                    </th>
                                    <th class="text-uppercase text-xs font-weight-bolder">
                                        Total Biaya
                                    </th>
                                    <th class="text-uppercase text-xs font-weight-bolder">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($bookings as $booking)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ Storage::url('avatars/' . $booking->user->avatar) }}"
                                                        class="avatar avatar-sm me-3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs">{{ $booking->user->name }}</h6>
                                                    <p class="text-xs mb-0">{{ $booking->user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $booking->vehicle_type == 'car' ? $booking->vehicle->nama_mobil : $booking->vehicle->nama_motor }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold">{{ $booking->days_count }}
                                                Hari</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold">Rp
                                                {{ number_format($booking->total_fee, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold">{{ $booking->booking_status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Ulasan terbaru</h6>
                    </div>
                    <div class="table-responsive p-4">
                        <table id="data-table" class="table table-hover text-nowrap text-center align-middle w-100">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xs font-weight-bolder">
                                        Nama
                                    </th>
                                    <th class="text-uppercase text-xs font-weight-bolder">
                                        Ulasan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($feedbacks as $feedback)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ Storage::url('avatars/' . $feedback->avatar) }}"
                                                        class="avatar avatar-sm me-3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs">{{ $feedback->user_name }}</h6>
                                                    <p class="text-xs mb-0">{{ $booking->user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $feedback->feedback }}
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <span id="currentYear"></span>
                            <a href="{{ url('tentang-kami') }}" class="font-weight-bold" target="_blank">ANKAVI TEAM</a>
                            Kelompok 5 MSIB Fullstack #4
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    @include('admin.layout.datatable')

    @push('styles')
        <style>
            .card-information {
                cursor: pointer;
            }

            @media (max-width: 991px) {
                .card.card-carousel {
                    display: none;
                }
            }
        </style>
    @endpush

    @push('script')
        <script>
            // Mendapatkan elemen dengan id "currentYear"
            var currentYearElement = document.getElementById('currentYear');

            // Memastikan elemen tersebut ada sebelum mengakses propertinya
            if (currentYearElement) {
                // Mengatur teks dari elemen tersebut menjadi tahun saat ini
                currentYearElement.textContent = new Date().getFullYear();
            }
        </script>
        <script src="{{ asset('frontend/js/argon/plugins/chartjs.min.js') }}"></script>
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                var chartData = @json(array_values($formattedIncomeData)); // Mengambil data grafik dari controller
                var chartLabels = @json(array_keys($formattedIncomeData)); // Mengambil label bulan dari controller
                var incomeData = @json(array_values($formattedIncomeData)); // Mengambil data grafik pendapatan dari controller

                var ctx2 = document.getElementById("chart-income").getContext("2d");

                var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
                gradientStroke2.addColorStop(1, "rgba(94, 114, 228, 0.2)");
                gradientStroke2.addColorStop(0.2, "rgba(94, 114, 228, 0.2)");
                gradientStroke2.addColorStop(0, "rgba(94, 114, 228, 0.2)");

                new Chart(ctx2, {
                    type: "bar",
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: "Total Pendapatan Rp ",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#5e72e4",
                            backgroundColor: gradientStroke2,
                            borderWidth: 3,
                            fill: true,
                            data: incomeData,
                            maxBarThickness: 6,
                        }, ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                        interaction: {
                            intersect: false,
                            mode: "index",
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5],
                                },
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    color: "#b2b9bf",
                                    font: {
                                        size: 11,
                                        family: "Open Sans",
                                        style: "normal",
                                        lineHeight: 2,
                                    },
                                },
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    borderDash: [5, 5],
                                },
                                ticks: {
                                    display: true,
                                    color: "#ccc",
                                    padding: 20,
                                    font: {
                                        size: 11,
                                        family: "Open Sans",
                                        style: "normal",
                                        lineHeight: 2,
                                    },
                                },
                            },
                        },
                    },
                });
            });
        </script> --}}
    @endpush
@endSection
