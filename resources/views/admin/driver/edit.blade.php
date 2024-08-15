@extends('admin.layout.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Driver</h3>
                            <a href="{{ route('admin.driver.index') }}" class="btn btn-success shadow-sm float-right"> 
                                <i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.driver.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row border-bottom pb-4">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Driver</label>
                                    <div class="col-sm-12">
                                        <input type="text"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" value="{{ $driver->nama }}" id="nama" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ $driver->email }}" id="email" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="nomor_telepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                                    <div class="col-sm-12">
                                        <input type="text"
                                            class="form-control @error('nomor_telepon') is-invalid @enderror"
                                            name="nomor_telepon" value="{{ $driver->nomor_telepon }}" id="nomor_telepon"
                                            required>
                                        @error('nomor_telepon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="ktp" class="col-sm-2 col-form-label">KTP</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $driver->ktp) }}" alt="image {{ $driver->ktp }}" class="img-fluid me-3" width="200">
                                        <a href="{{ route('admin.driver.edit_gambar', ['driver' => $driver->id, 'gambar' => 'ktp']) }}"
                                            class="btn btn-primary">
                                            <i class="fa fa-upload"></i> Upload Gambar
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="sim" class="col-sm-2 col-form-label">SIM</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $driver->sim) }}" alt="image {{ $driver->sim }}" class="img-fluid me-3" width="200">
                                        <a href="{{ route('admin.driver.edit_gambar', ['driver' => $driver->id, 'gambar' => 'sim']) }}"
                                            class="btn btn-primary">
                                            <i class="fa fa-upload"></i> Upload Gambar
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-12">
                                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="">-- Pilih Status --</option>
                                            @foreach (App\Models\User::getStatusOptions() as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $driver->status == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection