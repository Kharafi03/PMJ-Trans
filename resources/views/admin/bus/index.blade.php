@extends('admin.layout.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Bus</h3>
                            <a href="{{ route('admin.bus.create') }}" class="btn btn-success shadow-sm float-right"> 
                                <i class="fa fa-plus"></i> Tambah </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-striped table-hover text-nowrap table-responsive text-center align-middle w-100">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama</th>
                                            <th>Plat Nomor</th>
                                            <th>Warna</th>
                                            <th>Jumlah Penumpang</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($buses as $bus)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $bus->gambar1) }}" alt="image {{ $bus->bus_name }}" class="img-fluid" width="100">
                                                </td>
                                                <td>{{ $bus->nama_bus }}</td>
                                                <td>{{ $bus->plat_nomor }}</td>
                                                <td>{{ $bus->warna }}</td>
                                                <td>{{ $bus->jumlah_penumpang }}</td>
                                                <td>{{ $bus->status === 'aktif' ? 'Aktif' : 'Tidak Aktif' }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('admin.bus.edit', $bus->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.bus.destroy', $bus->id) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('admin.layout.datatable')