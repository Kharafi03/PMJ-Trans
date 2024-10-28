<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all">
    {{-- <link rel="stylesheet" href="{{ asset('css/frontend/css/argon-dashboard.css') }}"> --}}
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">
    @yield('content')
</body>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2@11.js') }}"></script>
<script src="{{ asset('js/fontawesome.js') }}"></script>
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

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
                timer: 1500,
                showConfirmButton: false
            });
        });
    </script>
@endif

</html>
