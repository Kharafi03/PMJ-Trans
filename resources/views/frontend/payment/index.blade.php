@extends('frontend.layouts.app')
@push('styles')
    <title>Payment</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/riwayatPembayaran-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="modalDp" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><img src="img/close.png"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" src="img/image-bus1.png" width="100%" height="100%" style="border-radius: 6px;">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPelunasan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><img src="img/close.png"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="img/image-bus1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Pelunasan 1</h5>
                                </div>
                              </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="img/image-bus1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Pelunasan 2</h5>
                                </div>
                              </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <img src="img/image-bus1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Pelunasan 3</h5>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <section id="riwayat-sewa">
        <div class="container mt-5">
            <div class="mb-3">
                <h3>Riwayat DP dan Pelunasan</h3>
            </div>
            <div class="tabel-riwayat justify-content-between align-items-center">
                <div class="row">
                    <div class="col-md-8" style="padding: 0px 30px;">
                        <p class="title">Detail Riwayat</p>
                    </div>
                    <div class="col-md-4" style="padding: 0px 30px;">
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-sliders"></i></span>
                                    <input type="text" class="form-control" placeholder="Filters" aria-describedby="basic-addon1">
                                </div> 
                            </div>
                        </div>
                    </div>                                    
                </div>
                <div style="overflow-x: auto;">
                    <table class="table-sewa table table-responsive align-items-center">
                        <thead>
                          <tr>
                            <th scope="col" style="background-color: #A8A8A840;">ID Booking</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Titik Jemput</th>
                            <th scope="col">Jenis Armada</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">DP</th>
                            <th scope="col">Pelunasan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>B0001</td>
                            <td>Nida Aulia Karima</td>
                            <td>Semarang</td>
                            <td>Jl. Nakula Raya, No.20, Pendrikan Kidul, Seamarang</td>
                            <td>PMJ Express</td>
                            <td>30 Agustus 2024</td>
                            <td>
                                <button type="button" onclick="modalDP()">
                                    <img src="img/image-bus1.png" class="img-fluid" width="100px" height="60px">
                                </button>
                            </td>
                            <td><button type="button" class="btn-lihat" onclick="modalPelunasan()">Lihat</button></td>
                          </tr>
                          <tr>
                            <td>B0001</td>
                            <td>Nida Aulia Karima</td>
                            <td>Semarang</td>
                            <td>Jl. Nakula Raya, No.20, Pendrikan Kidul, Seamarang</td>
                            <td>PMJ Express</td>
                            <td>30 Agustus 2024</td>
                            <td>
                                <button type="button" onclick="modalDP()">
                                    <img src="img/image-bus1.png" class="img-fluid" width="100px" height="60px">
                                </button>
                            </td>
                            <td><button type="button" class="btn-lihat" onclick="modalPelunasan()">Lihat</button></td>
                          </tr>
                        </tbody>
                    </table>
    
                </div>
        
                <div class="card-footer d-flex justify-content-between align-items-start" style="padding: 0px 20px;">
                    <span>
                        <p class="caption">Showing 1-5 from 1,269</p>
                    </span>
                    <nav >
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                            <li class="page-item "><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <button class="btn-kembali" type="button"><a href="">Kembali</a></button>
            </div>
        </div>
    </section>

    <!-- SCRIPT -->
     <script>
        function modalDP() {
            var myModal = new bootstrap.Modal(document.getElementById('modalDp'));
            myModal.show();
        };
        function modalPelunasan() {
            var myModal = new bootstrap.Modal(document.getElementById('modalPelunasan'));
            myModal.show();
        };
     </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection