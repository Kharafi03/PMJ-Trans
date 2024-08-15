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
                            <a href="{{ route('admin.driver.create') }}" class="btn btn-success shadow-sm float-right"> 
                                <i class="fa fa-plus"></i> Tambah </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-striped table-hover text-nowrap table-responsive text-center align-middle w-100">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nomor Telepon</th>
                                            <th>KTP</th>
                                            <th>SIM</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($drivers as $driver)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $driver->nama }}</td>
                                                <td>{{ $driver->nomor_telepon }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $driver->ktp) }}" alt="image {{ $driver->ktp }}" class="img-fluid" width="100">
                                                </td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $driver->sim) }}" alt="image {{ $driver->sim }}" class="img-fluid" width="100">
                                                </td>
                                                <td>{{ $driver->status === 'aktif' ? 'Aktif' : 'Tidak Aktif' }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('admin.driver.edit', $driver->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.driver.destroy', $driver->id) }}" method="POST" class="delete-form">
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