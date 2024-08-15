@extends('admin.layout.app')

@section('content')
    <section class="content pt-4" id="create_bus">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>
                            <a href="{{ route('admin.bus.index') }}" class="btn btn-success shadow-sm float-right"> <i
                                    class="fa fa-arrow-left"></i> Kembali</a>
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
                            <form method="post" action="{{ route('admin.bus.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row border-bottom pb-4">
                                    <label for="nama_bus" class="col-sm-2 col-form-label">Nama Bus</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('nama_bus') is-invalid @enderror"
                                            name="nama_bus" value="{{ old('nama_bus') }}" id="nama_bus" required>
                                        @error('nama_bus')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="plat_nomor" class="col-sm-2 col-form-label">Plat Nomor</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('nama_mobil') is-invalid @enderror"
                                            name="plat_nomor" value="{{ old('plat_nomor') }}" id="plat_nomor" required>
                                        @error('plat_nomor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="tahun" class="col-sm-2 col-form-label">Tahun Produksi</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                                            name="tahun" value="{{ old('tahun') }}" id="tahun" required>
                                        @error('tahun')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="warna" class="col-sm-2 col-form-label">Warna</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                            name="warna" value="{{ old('warna') }}" id="warna" required>
                                        @error('warna')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="no_mesin" class="col-sm-2 col-form-label">Nomor Mesin</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('no_mesin') is-invalid @enderror"
                                            name="no_mesin" value="{{ old('no_mesin') }}" id="no_mesin" required>
                                        @error('no_mesin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="no_sasis" class="col-sm-2 col-form-label">Nomor Sasis</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('no_sasis') is-invalid @enderror"
                                            name="no_sasis" value="{{ old('no_sasis') }}" id="no_sasis" required>
                                        @error('no_sasis')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="jumlah_penumpang" class="col-sm-2 col-form-label">Jumlah Penumpang</label>
                                    <div class="col-sm-12">
                                        <input type="number"
                                            class="form-control @error('jumlah_penumpang') is-invalid @enderror"
                                            name="jumlah_penumpang" value="{{ old('jumlah_penumpang') }}" id="penumpang"
                                            required>
                                        @error('penumpang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="bagasi" class="col-sm-2 col-form-label">Bagasi</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control @error('bagasi') is-invalid @enderror"
                                            name="bagasi" value="{{ old('bagasi') }}" id="bagasi" required>
                                        @error('bagasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Tambahkan input file untuk Gambar-1 -->
                                <div class="form-group row border-bottom pb-4">
                                    <label for="gambar1" class="col-sm-2 col-form-label">Gambar 1</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('gambar1') is-invalid @enderror"
                                            name="gambar1" value="{{ old('gambar1') }}"
                                            accept="image/png, image/jpeg, image/jpg">
                                        @error('gambar1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="gambar2" class="col-sm-2 col-form-label">Gambar-2</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('gambar2') is-invalid @enderror"
                                            name="gambar2" value="{{ old('gambar2') }}"
                                            accept="image/png, image/jpeg, image/jpg">
                                        @error('gambar2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="gambar3" class="col-sm-2 col-form-label">Gambar-3</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('gambar3') is-invalid @enderror"
                                            name="gambar3" value="{{ old('gambar3') }}"
                                            accept="image/png, image/jpeg, image/jpg">
                                        @error('gambar3')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="gambar4" class="col-sm-2 col-form-label">Gambar-4</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('gambar4') is-invalid @enderror"
                                            name="gambar4" value="{{ old('gambar4') }}"
                                            accept="image/png, image/jpeg, image/jpg">
                                        @error('gambar4')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-12">
                                        <select class="form-control @error('status') is-invalid @enderror" name="status"
                                            id="status">
                                            <option value="">-- Pilih Status --</option>
                                            @foreach (App\Models\Bus::getStatusOptions() as $key => $value)
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
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('input[type="number"]').on('keypress', function(event) {
                // Prevent "-" from being entered
                if (event.which === 45 || event.key === '-') {
                    event.preventDefault();
                }
            });

            $('input[type="number"]').on('input', function() {
                // Remove any negative signs that might have been pasted
                let value = $(this).val();
                if (value.indexOf('-') !== -1) {
                    $(this).val(value.replace('-', ''));
                }
            });

            $('input[type="number"]').on('blur', function() {
                // Ensure no negative value remains after input loses focus
                let value = $(this).val();
                if (value < 0) {
                    $(this).val(Math.abs(value)); // Convert negative to positive
                }
            });
        });
    </script>
@endpush
