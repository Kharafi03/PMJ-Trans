@extends('frontend.layouts.app')
@push('styles')
    <title>Terms and Condition</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/syaratKetentuan-style.css') }}" rel="stylesheet" />

@endpush
@section('content')
    <!-- NAVBAR -->
    <x-navbar-customer />

        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="mb-4" style="font-size: 44px; font-weight: 700; color: #1E9781;">Syarat <span style="color: #FD9C07;">& Ketentuan</span></h1>
                    <p class="mb-4" style="font-size: 16px; font-weight: 500; color: #666666B5;">Mari mengenal kami lebih lanjut melalui artikel dibawah ini, yang memberikan gambaran singkat mengenai Syarat dan Ketentuan di PMJ Trans.p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('img/terms-condition-image.png') }}" style="width: 100%; height: 100%; align-items:center; padding: 30px;" alt="gambar">
                    <!-- src="{{ asset('frontend/img/carousel/carousel-2.jpg') }}" -->
                </div>
            </div>
        </div>

        <section id="syaratKetentuan">
            <div class="container mb-5">
                <div class="col-md-6 mt-lg-5">
                    <h1 class="mb-4" style="font-size: 35px; font-weight: 700; color: #1E9781;">Syarat <span style="color: #FD9C07;">& Ketentuan</span></h1>
                </div>
                <div class="content">
                    <div class="syarat-content">
                        <h5>Umum</h5>
                        <ol>
                            <li>Dengan menggunakan layanan penyewaan bus di PMJ Trans, Anda setuju untuk mematuhi semua syarat dan ketentuan yang berlaku.</li>
                            <li>PMJ Trans berhak memperbarui atau mengubah syarat dan ketentuan ini kapan saja tanpa pemberitahuan terlebih dahulu.</li>
                        </ol>
                    </div>
                    <div class="syarat-content">
                        <h5>Pemesanan dan Pembayaran</h5>
                        <ol>
                            <li>Pemesanan harus dilakukan minimal 7 hari sebelum tanggal keberangkatan.</li>
                            <li>Pembayaran dilakukan dalam dua tahap: DP (Down Payment) sebesar 30% dari total biaya sewa dan pelunasan 70% dilakukan maksimal 2 hari sebelum keberangkatan.</li>
                            <li>Semua pembayaran dilakukan melalui transfer bank ke rekening resmi PMJ Trans yang akan diberikan saat konfirmasi pemesanan.</li>
                        </ol>
                    </div>
                    <div class="syarat-content">
                        <h5>Pembetulan dan Pengembalian Dana</h5>
                        <ol>
                            <li>Pembatalan yang dilakukan lebih dari 3 hari sebelum keberangkatan akan dikenakan biaya administrasi sebesar 10% dari total biaya sewa.</li>
                            <li>Pembatalan yang dilakukan dalam waktu kurang dari 3 hari sebelum keberangkatan tidak akan mendapatkan pengembalian dana (DP hangus).</li>
                            <li>LPMJ Trans berhak membatalkan perjalanan jika terdapat kondisi yang membahayakan keselamatan atau terjadi force majeure, dengan pengembalian dana penuh kepada penyewa.</li>
                        </ol>
                    </div>
                    <div class="syarat-content">
                        <h5>Tanggung Jawab Penyewa</h5>
                        <ol>
                            <li>Penyewa bertanggung jawab penuh atas kerusakan atau kehilangan barang yang terjadi di dalam bus selama masa sewa.</li>
                            <li>Dilarang membawa barang-barang yang melanggar hukum atau berbahaya selama perjalanan.</li>
                            <li>Dilarang merokok, mengonsumsi alkohol, atau menggunakan narkotika di dalam bus.</li>
                        </ol>
                    </div>
                    <div class="syarat-content">
                        <h5>Tanggung Jawab PMJ Trans</h5>
                        <ol>
                            <li>PMJ Trans bertanggung jawab untuk menyediakan bus dalam kondisi bersih, layak jalan, dan sesuai dengan kesepakatan.</li>
                            <li>PMJ Trans menyediakan sopir profesional yang berpengalaman dan memiliki SIM yang sesuai.</li>
                            <li>PMJ Trans tidak bertanggung jawab atas keterlambatan atau gangguan perjalanan yang disebabkan oleh faktor-faktor di luar kendali, seperti lalu lintas padat, bencana alam, kerusakan mekanis yang mendadak, atau tindakan pihak ketiga.</li>
                        </ol>
                    </div>
                    <div class="syarat-content">
                        <h5>Pengguna Bus</h5>
                        <ol>
                            <li>Penggunaan bus hanya untuk keperluan yang telah disepakati pada saat pemesanan.</li>
                            <li>Setiap perubahan rute atau tambahan waktu penggunaan harus disetujui oleh PMJ Trans dan dapat dikenakan biaya tambahan.</li>
                            <li>Penyewa wajib mengikuti instruksi dari sopir selama perjalanan demi keselamatan dan kenyamanan.</li>
                        </ol>
                    </div>
                    <div class="syarat-content">
                        <h5>Asuransi dan Keamanan</h5>
                        <ol>
                            <li>PMJ Trans menyediakan asuransi untuk penumpang selama perjalanan sesuai dengan ketentuan yang berlaku.</li>
                            <li>Penyewa disarankan untuk memiliki asuransi tambahan jika diperlukan untuk perlindungan lebih lanjut.</li>
                        </ol>
                    </div>
                    <div class="syarat-content">
                        <h5>Pembatasan Tanggung Jawab</h5>
                        <ol>
                            <li>PMJ Trans tidak bertanggung jawab atas kehilangan atau kerusakan barang pribadi penumpang selama perjalanan.</li>
                            <li>Segala kerugian atau kerusakan yang diakibatkan oleh kelalaian penyewa atau penumpang sepenuhnya menjadi tanggung jawab penyewa.</li>
                        </ol>
                    </div>
                    <div class="syarat-content">
                        <h5>Penyelesaian Sengketa</h5>
                        <ol>
                            <li>Segala sengketa yang timbul akibat penggunaan layanan penyewaan bus akan diselesaikan secara musyawarah untuk mufakat.</li>
                            <li>Jika tidak tercapai kesepakatan, maka sengketa akan diselesaikan sesuai dengan hukum yang berlaku di Indonesia.</li>
                        </ol>
                    </div>
                    <div class="syarat-content">
                        <h5>Kontak</h5>
                        <ol>
                            <li>Untuk pertanyaan lebih lanjut mengenai penyewaan bus, Anda dapat menghubungi layanan pelanggan PMJ Trans melalui nomor telepon atau email yang tertera di situs resmi kami.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- VERSI 2 -->
        <section id="syaratKetentuan">
            <div class="container mb-5">
                <div class="col-md-6 mt-lg-5">
                    <h1 class="mb-4" style="font-size: 35px; font-weight: 700; color: #1E9781;">Syarat <span style="color: #FD9C07;">& Ketentuan</span></h1>
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
                                <ol>
                                    <li>Dengan menggunakan layanan penyewaan bus di PMJ Trans, Anda setuju untuk mematuhi semua syarat dan ketentuan yang berlaku.</li>
                                    <li>PMJ Trans berhak memperbarui atau mengubah syarat dan ketentuan ini kapan saja tanpa pemberitahuan terlebih dahulu.</li>
                                </ol>
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
                                <ol>
                                    <li>Pemesanan harus dilakukan minimal 7 hari sebelum tanggal keberangkatan.</li>
                                    <li>Pembayaran dilakukan dalam dua tahap: DP (Down Payment) sebesar 30% dari total biaya sewa dan pelunasan 70% dilakukan maksimal 2 hari sebelum keberangkatan.</li>
                                    <li>Semua pembayaran dilakukan melalui transfer bank ke rekening resmi PMJ Trans yang akan diberikan saat konfirmasi pemesanan.</li>
                                </ol>
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
                                <ol>
                                    <li>Pembatalan yang dilakukan lebih dari 3 hari sebelum keberangkatan akan dikenakan biaya administrasi sebesar 10% dari total biaya sewa.</li>
                                    <li>Pembatalan yang dilakukan dalam waktu kurang dari 3 hari sebelum keberangkatan tidak akan mendapatkan pengembalian dana (DP hangus).</li>
                                    <li>LPMJ Trans berhak membatalkan perjalanan jika terdapat kondisi yang membahayakan keselamatan atau terjadi force majeure, dengan pengembalian dana penuh kepada penyewa.</li>
                                </ol>
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
                                <ol>
                                    <li>Penyewa bertanggung jawab penuh atas kerusakan atau kehilangan barang yang terjadi di dalam bus selama masa sewa.</li>
                                    <li>Dilarang membawa barang-barang yang melanggar hukum atau berbahaya selama perjalanan.</li>
                                    <li>Dilarang merokok, mengonsumsi alkohol, atau menggunakan narkotika di dalam bus.</li>
                                </ol>
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
                                <ol>
                                    <li>PMJ Trans bertanggung jawab untuk menyediakan bus dalam kondisi bersih, layak jalan, dan sesuai dengan kesepakatan.</li>
                                    <li>PMJ Trans menyediakan sopir profesional yang berpengalaman dan memiliki SIM yang sesuai.</li>
                                    <li>PMJ Trans tidak bertanggung jawab atas keterlambatan atau gangguan perjalanan yang disebabkan oleh faktor-faktor di luar kendali, seperti lalu lintas padat, bencana alam, kerusakan mekanis yang mendadak, atau tindakan pihak ketiga.</li>
                                </ol>
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
                                <ol>
                                    <li>Penggunaan bus hanya untuk keperluan yang telah disepakati pada saat pemesanan.</li>
                                    <li>Setiap perubahan rute atau tambahan waktu penggunaan harus disetujui oleh PMJ Trans dan dapat dikenakan biaya tambahan.</li>
                                    <li>Penyewa wajib mengikuti instruksi dari sopir selama perjalanan demi keselamatan dan kenyamanan.</li>
                                </ol>
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
                                <ol>
                                    <li>PMJ Trans menyediakan asuransi untuk penumpang selama perjalanan sesuai dengan ketentuan yang berlaku.</li>
                                    <li>Penyewa disarankan untuk memiliki asuransi tambahan jika diperlukan untuk perlindungan lebih lanjut.</li>
                                </ol>
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
                                <ol>
                                    <li>PMJ Trans tidak bertanggung jawab atas kehilangan atau kerusakan barang pribadi penumpang selama perjalanan.</li>
                                    <li>Segala kerugian atau kerusakan yang diakibatkan oleh kelalaian penyewa atau penumpang sepenuhnya menjadi tanggung jawab penyewa.</li>
                                </ol>
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
                                <ol>
                                    <li>Segala sengketa yang timbul akibat penggunaan layanan penyewaan bus akan diselesaikan secara musyawarah untuk mufakat.</li>
                                    <li>Jika tidak tercapai kesepakatan, maka sengketa akan diselesaikan sesuai dengan hukum yang berlaku di Indonesia.</li>
                                </ol>
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
                                <ol>
                                    <li>Untuk pertanyaan lebih lanjut mengenai penyewaan bus, Anda dapat menghubungi layanan pelanggan PMJ Trans melalui nomor telepon atau email yang tertera di situs resmi kami.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </section>

        <!-- FOOTER -->
         <x-footer-customer/>
@endsection
        