@if ($errors->any())
    @push('styles')
        <style>
            .alert{
                border: 1px solid #CA383A;
                border-radius: 8px;
                background-color: #F9D2CA;
            }
            strong, strong i{
                color: #CA383A;
                font-size: 14px;
            }
            strong i{
                padding-right: 10px;
            }
            .alert hr {
                border: none;
                margin: 0; 
            }
            .btn-close{
                font-size: 10px !important;
            }
            p{
                color: #181818;
                font-size: 14px;
                font-weight: 400;
                margin-left: 18px;
                padding-top: 5px;
            }
        </style>
    @endpush
    <div class="alert alert-dismissible show p-3" role="alert">
        <div class="d-flex align-items-center">
            <strong><i class="fa-solid fa-triangle-exclamation"></i> Terjadi Kesalahan:</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <hr>
        <p class="mb-0 ps-3 text-start">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </p>
    </div>
@endif
