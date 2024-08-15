@extends('admin.layout.app')

@section('content')
    <section class="content pt-4" id="edit_gambar_bus">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Gambar {{ $gambar }}</h3>
                            <a href="{{ route('admin.bus.edit', $bus) }}" class="btn btn-success shadow-sm float-right">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form method="post"
                                action="{{ route('admin.bus.update_gambar', ['bus' => $bus->id, 'gambar' => $gambar]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row border-bottom pb-4">
                                    <label for="{{ $gambar }}" class="col-sm-2 col-form-label">Gambar
                                        {{ $gambar }}</label>
                                    <div class="col-sm-12">
                                        <input type="file" name="{{ $gambar }}"
                                            class="form-control @error('{{ $gambar }}') is-invalid @enderror"
                                            accept="image/*">
                                        @error('{{ $gambar }}')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn btn-success">Simpan Gambar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
