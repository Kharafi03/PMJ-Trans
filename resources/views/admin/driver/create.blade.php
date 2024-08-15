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
                            <a href="{{ route('admin.driver.index') }}" class="btn btn-success shadow-sm float-right"> <i
                                    class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.driver.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row border-bottom pb-4">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Driver</label>
                                    <div class="col-sm-12">
                                        <input type="text"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" value="{{ old('nama') }}" id="nama" required>
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
                                            name="email" value="{{ old('email') }}" id="email" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-12">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" value="{{ old('password') }}" id="password" required>
                                        @error('password')
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
                                            name="nomor_telepon" value="{{ old('nomor_telepon') }}" id="nomor_telepon"
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
                                        <input type="file" class="form-control @error('ktp') is-invalid @enderror"
                                            name="ktp" value="{{ old('ktp') }}" id="ktp" required>
                                        @error('ktp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="sim" class="col-sm-2 col-form-label">SIM</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('sim') is-invalid @enderror"
                                            name="sim" value="{{ old('sim') }}" id="sim" required>
                                        @error('sim')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-12">
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="">-- Pilih Status --</option>
                                            @foreach (App\Models\User::getStatusOptions() as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('status') == $key ? 'selected' : '' }}>
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
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@include('admin.layout.datatable')
