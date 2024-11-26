<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all">
    {{-- <link rel="stylesheet" href="{{ asset('css/frontend/css/argon-dashboard.css') }}"> --}}

    {{-- <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}"> --}}

    <!-- Tambahkan Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Tambahkan WOW.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <!-- FONT -->
    <style>
        @font-face {
            font-family: 'Poppins';
            src: url('{{ asset('fonts/fonts/Poppins-ExtraLight.woff2') }}') format('woff2');
            font-weight: 300;
            font-style: normal;
        }

        @font-face {
            font-family: 'Poppins';
            src: url( '{{ asset('fonts/Poppins-Regular.woff2') }}') format('woff2');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Poppins';
            src: url('{{ asset('fonts/Poppins-Medium.woff2') }}') format('woff2');
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: 'Poppins';
            src: url('{{ asset('fonts/Poppins-SemiBold.woff2')}}') format('woff2');
            font-weight: 600;
            font-style: normal;
        }

        @font-face {
            font-family: 'Poppins';
            src: url('{{ asset('fonts/Poppins-Bold.woff2')}}') format('woff2');
            font-weight: 700;
            font-style: normal;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ asset('fonts/PlusJakartaSans-Regular.woff2')}}') format('woff2');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ asset('fonts/PlusJakartaSans-Medium.woff2')}}') format('woff2');
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ asset('fonts/PlusJakartaSans-SemiBold.woff2')}}') format('woff2');
            font-weight: 600;
            font-style: normal;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ asset('fonts/PlusJakartaSans-Bold.woff2')}}') format('woff2');
            font-weight: 700;
            font-style: normal;
        }
    </style>
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">
    @yield('content')
</body>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2@11.js') }}"></script>
<script src="{{ asset('js/fontawesome.js') }}"></script>
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
{{-- <script src="{{ asset('js/wow.min.js') }}"></script> --}}

@stack('scripts')

@if (session('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '{{ session('alert-type') == 'success'
                    ? 'Berhasil!'
                    : (session('alert-type') == 'danger'
                        ? 'Terhapus!'
                        : (session('alert-type') == 'info'
                            ? 'Berhasil!'
                            : '')) }}',
                text: '{{ session('message') }}',
                icon: '{{ session('alert-type') }}',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'custom-ok-button' // Tambahkan class khusus
                }
            });
        });
    </script>
    <style>
        .custom-ok-button {
            background-color: #1E9781;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .custom-ok-button:hover {
            background-color: #1E9781;
        }
    </style>
@endif

</html>
