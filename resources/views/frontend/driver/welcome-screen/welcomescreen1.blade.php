@extends('frontend.layouts.app')
@push('styles')
    <title>Welcome Screen</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/welcomeScreenDriver-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <section id="welcomeScreen">
        <div class="dashboard-container">
            <div class="welcome-screen">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{asset('img/welcome1.png')}}" class="img-fluid">
                </div>
                <div class="welcome-text text-center">
                    <h5 style="font-size: 25px; font-weight: 700; color: #1E9781;">Detail <span style="color: #FD9C07;">Pemesanan</span></h5>
                    <p>
                        Kami senang Anda bergabung!<br>
                        Sebagai driver, Anda berperan penting dalam memberikan pengalaman perjalanan terbaik bagi customer.
                    </p>
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="#" class="btn-next"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection