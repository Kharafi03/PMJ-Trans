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
                    <p style="font-size: 16px; font-weight: 500; color: #666666B5; margin-top:0px;">Mari mengenal kami lebih lanjut melalui artikel dibawah ini, yang memberikan gambaran singkat mengenai Syarat dan Ketentuan di {{ $setting ? $setting->name : '#' }}.</p>
                </div>
                <div class="accordion accordion-flush" id="sk">
                    @forelse ($terms as $term)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sk{{ $loop->iteration }}" aria-expanded="false">
                                    {{ $term->heading }}
                                </button>
                            </h2>
                            <div id="sk{{ $loop->iteration }}" class="accordion-collapse collapse" data-bs-parent="#sk">
                                <div class="accordion-body">
                                    {!! nl2br(e($term->description)) !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center" role="alert">
                            <h4 class="alert-heading">Informasi</h4>
                            <p>Belum ada data yang tersedia. Silakan cek kembali nanti.</p>
                        </div>
                    @endforelse
                </div>  
            </div>
        </section>

    <!-- FOOTER -->
    <x-footer-customer/>
@endsection
        