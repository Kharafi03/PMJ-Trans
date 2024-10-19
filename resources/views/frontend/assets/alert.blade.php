@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 p-3" role="alert">
        <div class="d-flex align-items-center">
            <strong class="me-auto">Terjadi Kesalahan:</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <hr>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li class="text-start">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
