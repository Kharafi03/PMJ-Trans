@extends('frontend.layouts.app')
@push('styles')
    <title>Booking Code</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/kodeBooking-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@section('content')
        <!-- CONTENT - TITLE -->
        <section id="title">
      <div class="container mt-5">
        <h5><b>KODE BOOKING</b></h5>
        <p style="color:#6666">Pilih jadwal, destinasi, serta tipe kendaraan yang sesuai dengan kebutuhan Anda. Rasakan pengalaman perjalanan yang nyaman bersama layanan PMJ Trans</p>
      </div>
     </section>

    <!-- CONTENT -->
     <section id="kode">
        <div class="container-kode container">
            <div class="text-content">
                <h5><b>E-Ticket</b></h5>
                <p>PMJ Trans , Pemalang, Comal 23 G.g Kenanga 34</p>  
            </div>
            <div class="ticket-card" style="background-image: url('img/vector.png');">
                <div class="ticket-content">
                    <div class="row">
                        <div class="col-md-3 mt-4 title">
                            <h3>PMJ TRANS</h3>
                            <!-- <p style="color: white;">PMJ Trans</p> -->
                        </div>
                        <div class="col-md-9">
                          <h6>Rabu, 21 Agustus 2024</h6>
                            <div class="row mt-4" >
                              <div class="col-md-7">
                                  <div class="row ">
                                    <div class="col-md-4">
                                      <h6>08:30</h6>
                                    </div>
                                    <div class="col-md-8">
                                      <h6>Jakarta</h6>
                                      <p class="caption">Jl. Melati No.40</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4">
                                      <h6>08:30</h6>
                                    </div>
                                    <div class="col-md-8">
                                      <h6>Jakarta</h6>
                                      <p class="caption">Jl. Melati No.40</p>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-5" style="position: relative;">   
                                  <h6>Kode Booking</h6>
                                  <p style="font-size: 25px;color:white;">A0937645123</p>
                              </div>
                            </div>
                            <hr style="border: 0; height: 3px; background-color: white; opacity: 100%;">

                            <div class="row info">
                              <div class="col-md-4 mb-3">
                                <div class="align-items-center text-center">
                                  <i class="fa-solid fa-ticket-simple">&nbsp;</i>
                                  <p class="mb-0 small" style="text-align: justify;">Tunjukkan e-tiket dan identitas penumpang saat pengambilan bus</p>
                                </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <div class="align-items-center text-center" >
                                  <i class="fa-solid fa-clock">&nbsp;</i><br>
                                  <p class="mb-0 small" style="text-align: justify;">Harap datang tepat waktu, keterlambatan maximal  40 menit sebeleum keberangkatan</p>
                                </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <div class="align-items-center text-center">
                                  <i class="fa-solid fa-triangle-exclamation">&nbsp;</i><br>
                                  <p class="mb-0 small" style="text-align: justify;">Dilarang membawa senjata atau hal lain yang membahayakan</p>
                                </div>
                              </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <div class="group">
                    <i class="fa-solid fa-file-arrow-down" style="font-size: 60px;color: red; margin: 20px 0px 20px 35px;"></i><br>
                    <button class="btn-download">Download Tiket</button>
                </div>
            </div>
        </div>      
     </section>

    <!-- BUTTON -->
     <div class="container">
      <div class="d-flex justify-content-between">
        <button class="btn-prev" type="submit"><a href="#" style="text-decoration: none;color:white">Kembali</a></button>
        <button class="btn-next" type="submit"><a href="#" style="text-decoration: none;color:white">Selanjutnya</a></button>
      </div>
    </div>
       


    <!-- SCRIPT JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@endsection
@push('style-alt')
    <style>
        .ticket-card{
            background-image: url('img/vector.png');
        }
        @media (max-width: 767.98px) {
        /* Media query for mobile devices */
            .ticket-card{
                background-image: url('img/vector2.png');
            }
        }
    </style>
@endpush