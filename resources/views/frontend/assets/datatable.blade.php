@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('css/frontend/css/dataTables.bootstrap5.css') }}">
    <style>
        .table td  {
            white-space: normal;
            word-wrap: break-word;
        }
        .table th {
            text-align: center !important;
            white-space: normal;
            word-wrap: break-word;
            vertical-align: middle;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.js') }}"></script>
    <script>
        new DataTable('.table');
    </script>
@endpush