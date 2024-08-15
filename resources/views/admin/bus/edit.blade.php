@extends('admin.layout.app')

@section('content')
    <section class="content pt-4" id="edit_bus">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Bus</h3>
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
                            <form method="post" action="{{ route('admin.bus.update', $bus->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row border-bottom pb-4">
                                    <label for="nama_bus" class="col-sm-2 col-form-label">Nama Bus</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('nama_bus') is-invalid @enderror"
                                            name="nama_bus" value="{{ $bus->nama_bus }}" id="nama_bus" required>
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
                                        <input type="text" class="form-control @error('plat_nomor') is-invalid @enderror"
                                            name="plat_nomor" value="{{ $bus->plat_nomor }}" id="plat_nomor" required>
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
                                            name="tahun" value="{{ $bus->tahun }}" id="tahun" required">
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
                                            name="warna" value="{{ $bus->warna }}" id="warna" required>
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
                                            name="no_mesin" value="{{ $bus->no_mesin }}" id="no_mesin" required>
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
                                            name="no_sasis" value="{{ $bus->no_sasis }}" id="no_sasis" required>
                                        @error('no_sasis')
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
                                            name="bagasi" value="{{ $bus->bagasi }}" id="bagasi" required>
                                        @error('bagasi')
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
                                            name="jumlah_penumpang" value="{{ $bus->jumlah_penumpang }}"
                                            id="jumlah_penumpang" required>
                                        @error('jumlah_penumpang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="gambar1" class="col-sm-2 col-form-label">Gambar 1</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $bus->gambar1) }}"
                                            alt="image {{ $bus->bus_name }}" class="img-fluid me-3" width="200">
                                        <a href="{{ route('admin.bus.edit_gambar', ['bus' => $bus->id, 'gambar' => 'gambar1']) }}"
                                            class="btn btn-primary">
                                            <i class="fa fa-upload"></i> Upload Gambar
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="gambar2" class="col-sm-2 col-form-label">Gambar 2</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $bus->gambar2) }}"
                                            alt="image {{ $bus->bus_name }}" class="img-fluid me-3" width="200">
                                        <a href="{{ route('admin.bus.edit_gambar', ['bus' => $bus->id, 'gambar' => 'gambar2']) }}"
                                            class="btn btn-primary">
                                            <i class="fa fa-upload"></i> Upload Gambar
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="gambar3" class="col-sm-2 col-form-label">Gambar 3</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $bus->gambar3) }}"
                                            alt="image {{ $bus->bus_name }}" class="img-fluid me-3" width="200">
                                        <a href="{{ route('admin.bus.edit_gambar', ['bus' => $bus->id, 'gambar' => 'gambar3']) }}"
                                            class="btn btn-primary">
                                            <i class="fa fa-upload"></i> Upload Gambar
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="gambar4" class="col-sm-2 col-form-label">Gambar 4</label>
                                    <div class="col-sm-12">
                                        <img src="{{ asset('storage/' . $bus->gambar4) }}"
                                            alt="image {{ $bus->bus_name }}" class="img-fluid me-3" width="200">
                                        <a href="{{ route('admin.bus.edit_gambar', ['bus' => $bus->id, 'gambar' => 'gambar4']) }}"
                                            class="btn btn-primary">
                                            <i class="fa fa-upload"></i> Upload Gambar
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-12">
                                        <select name="status" class="form-control @error('status') is-invalid @enderror"
                                            id="status">
                                            <option value="">-- Pilih Status --</option>
                                            @foreach (App\Models\Bus::getStatusOptions() as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $bus->status == $key ? 'selected' : '' }}>{{ $value }}
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
