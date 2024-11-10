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
                <div class="text-content wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                    <h1 class="mb-2">Syarat <span>& Ketentuan</span></h1>
                    <p class="mb-5" >Mari mengenal kami lebih lanjut melalui artikel dibawah ini, yang memberikan gambaran singkat mengenai Syarat dan Ketentuan di {{ $setting ? $setting->name : '#' }}.</p>
                </div>
                <div class="accordion accordion-flush" id="sk">
                    @forelse ($terms as $term)
                        <div class="accordion-item wow animate__animated animate__fadeInUp">
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

    @push('scripts')
        <script>
            new WOW().init();
        </script>
    @endpush
@endsection
        