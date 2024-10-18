@extends('frontend.layouts.app')
@push('styles')
    <title>Welcome Screen</title>
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/welcomeScreenDriver-style.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <section id="welcomeScreen">
        <div class="dashboard-container">
            <div class="welcome-screen">
                <div class="d-flex align-items-center justify-content-center mt-5">
                    <img src="{{asset('img/welcome3.png')}}" class="img-fluid">
                </div>
                <div class="welcome-text text-center">
                    <h5 style="font-size: 25px; font-weight: 700; color: #1E9781;">Komunikasi <span style="color: #FD9C07;">dan Profesionalisme</span></h5>
                    <p>
                        Bangun komunikasi yang baik dengan customer dan jaga sikap profesional untuk memberikan layanan terbaik.
                    </p>
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="#" class="btn-next"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection