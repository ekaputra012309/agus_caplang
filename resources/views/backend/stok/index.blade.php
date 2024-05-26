@extends('backend/template/app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stok</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
                            <li class="breadcrumb-item active">Stok</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> </h3>
                                <div class="card-tools">
                                    <a href="{{ route('stok.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Add Data
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama TL</th>
                                            <th>Nama SPG</th>
                                            <th>Area</th>
                                            <th>Nama Toko</th>
                                            <th>Kategori</th>
                                            <th>Brand</th>
                                            <th>SKU</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datastok as $stok)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item text-primary"
                                                                href="{{ route('stok.edit', $stok->id) }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item text-danger"
                                                                href="{{ route('stok.destroy', $stok->id) }}"
                                                                data-confirm-delete="true">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $stok->nama_tl }}</td>
                                                <td>{{ $stok->spg->nama_lengkap }}</td>
                                                <td>{{ $stok->area }}</td>
                                                <td>{{ $stok->outlet->outlet }}</td>
                                                <td>{{ $stok->Sku->kategori }}</td>
                                                <td>{{ $stok->Sku->brand }}</td>
                                                <td>{{ $stok->Sku->keterangan }}</td>
                                                <td>{{ $stok->stok }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        </script>
    </div>
@endsection
