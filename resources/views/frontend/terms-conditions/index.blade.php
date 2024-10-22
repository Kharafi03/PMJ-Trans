@extends('frontend.layouts.app')
@push('styles')
    <title>Terms and Condition</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/syaratKetentuan-style.css') }}" rel="stylesheet" />

@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

        <!-- VERSI 2 -->
        <section id="syaratKetentuan">
            <div class="container mb-5">
                <div class="text-content">
                    <h1 style="font-size: 44px; font-weight: 700; color: #1E9781; margin-bottom:10px;">Syarat <span style="color: #FD9C07;">& Ketentuan</span></h1>
                    <p style="font-size: 16px; font-weight: 500; color: #666666B5; margin-top:0px;">Mari mengenal kami lebih lanjut melalui artikel dibawah ini, yang memberikan gambaran singkat mengenai Syarat dan Ketentuan di PMJ Trans.</p>
                </div>
                <div class="accordion accordion-flush" id="sk">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk1" aria-expanded="false">
                                Umum
                            </button>
                        </h2>
                        <div id="sk1" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>Dengan menggunakan layanan penyewaan bus di PMJ Trans, Anda setuju untuk mematuhi semua syarat dan ketentuan yang berlaku.</li>
                                    <li>PMJ Trans berhak memperbarui atau mengubah syarat dan ketentuan ini kapan saja tanpa pemberitahuan terlebih dahulu.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk2" aria-expanded="false">
                                Pemesanan dan Pembayaran
                            </button>
                        </h2>
                        <div id="sk2" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>Pemesanan harus dilakukan minimal 7 hari sebelum tanggal keberangkatan.</li>
                                    <li>Pembayaran dilakukan dalam dua tahap: DP (Down Payment) sebesar 30% dari total biaya sewa dan pelunasan 70% dilakukan maksimal 2 hari sebelum keberangkatan.</li>
                                    <li>Semua pembayaran dilakukan melalui transfer bank ke rekening resmi PMJ Trans yang akan diberikan saat konfirmasi pemesanan.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk3" aria-expanded="false">
                                Pembetulan dan Pengembalian Dana
                            </button>
                        </h2>
                        <div id="sk3" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>Pembatalan yang dilakukan lebih dari 3 hari sebelum keberangkatan akan dikenakan biaya administrasi sebesar 10% dari total biaya sewa.</li>
                                    <li>Pembatalan yang dilakukan dalam waktu kurang dari 3 hari sebelum keberangkatan tidak akan mendapatkan pengembalian dana (DP hangus).</li>
                                    <li>LPMJ Trans berhak membatalkan perjalanan jika terdapat kondisi yang membahayakan keselamatan atau terjadi force majeure, dengan pengembalian dana penuh kepada penyewa.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk4" aria-expanded="false">
                            Tanggung Jawab Penyewa
                            </button>
                        </h2>
                        <div id="sk4" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>Penyewa bertanggung jawab penuh atas kerusakan atau kehilangan barang yang terjadi di dalam bus selama masa sewa.</li>
                                    <li>Dilarang membawa barang-barang yang melanggar hukum atau berbahaya selama perjalanan.</li>
                                    <li>Dilarang merokok, mengonsumsi alkohol, atau menggunakan narkotika di dalam bus.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk5" aria-expanded="false">
                                Tanggung Jawab PMJ Trans
                            </button>
                        </h2>
                        <div id="sk5" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>PMJ Trans bertanggung jawab untuk menyediakan bus dalam kondisi bersih, layak jalan, dan sesuai dengan kesepakatan.</li>
                                    <li>PMJ Trans menyediakan sopir profesional yang berpengalaman dan memiliki SIM yang sesuai.</li>
                                    <li>PMJ Trans tidak bertanggung jawab atas keterlambatan atau gangguan perjalanan yang disebabkan oleh faktor-faktor di luar kendali, seperti lalu lintas padat, bencana alam, kerusakan mekanis yang mendadak, atau tindakan pihak ketiga.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk6" aria-expanded="false">
                                Pengguna Bus
                            </button>
                        </h2>
                        <div id="sk6" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>Penggunaan bus hanya untuk keperluan yang telah disepakati pada saat pemesanan.</li>
                                    <li>Setiap perubahan rute atau tambahan waktu penggunaan harus disetujui oleh PMJ Trans dan dapat dikenakan biaya tambahan.</li>
                                    <li>Penyewa wajib mengikuti instruksi dari sopir selama perjalanan demi keselamatan dan kenyamanan.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk7" aria-expanded="false">
                                Asuransi dan Keamanan
                            </button>
                        </h2>
                        <div id="sk7" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>PMJ Trans menyediakan asuransi untuk penumpang selama perjalanan sesuai dengan ketentuan yang berlaku.</li>
                                    <li>Penyewa disarankan untuk memiliki asuransi tambahan jika diperlukan untuk perlindungan lebih lanjut.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk8" aria-expanded="false">
                            Pembatasan Tanggung Jawab
                            </button>
                        </h2>
                        <div id="sk8" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>PMJ Trans tidak bertanggung jawab atas kehilangan atau kerusakan barang pribadi penumpang selama perjalanan.</li>
                                    <li>Segala kerugian atau kerusakan yang diakibatkan oleh kelalaian penyewa atau penumpang sepenuhnya menjadi tanggung jawab penyewa.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk9" aria-expanded="false">
                                Penyelesaian Sengketa
                            </button>
                        </h2>
                        <div id="sk9" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>Segala sengketa yang timbul akibat penggunaan layanan penyewaan bus akan diselesaikan secara musyawarah untuk mufakat.</li>
                                    <li>Jika tidak tercapai kesepakatan, maka sengketa akan diselesaikan sesuai dengan hukum yang berlaku di Indonesia.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk10" aria-expanded="false">
                                Kontak
                            </button>
                        </h2>
                        <div id="sk10" class="accordion-collapse collapse" data-bs-parent="#sk">
                            <div class="accordion-body">
                                <ul>
                                    <li>Untuk pertanyaan lebih lanjut mengenai penyewaan bus, Anda dapat menghubungi layanan pelanggan PMJ Trans melalui nomor telepon atau email yang tertera di situs resmi kami.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </section>

        <!-- FOOTER -->
         <x-footer-customer/>
@endsection
        