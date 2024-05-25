@extends('backend/template/app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Event</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
                            <li class="breadcrumb-item active">Event</li>
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
                                    <a href="{{ route('event.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Add Data
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Area</th>
                                            <th>Nama TL</th>
                                            <th>Nama SPG1</th>
                                            <th>Nama SPG2</th>
                                            <th>Tanggal</th>
                                            <th>SKU</th>
                                            <th>QTY</th>
                                            <th>Harga Satuan</th>
                                            <th>Total Penjualan</th>
                                            <th>Target Penjualan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataevent as $event)
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
                                                                href="{{ route('event.edit', $event->id) }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item text-danger"
                                                                href="{{ route('event.destroy', $event->id) }}"
                                                                data-confirm-delete="true">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $event->tl->area }}</td>
                                                <td>{{ $event->tl->nama_tl }}</td>
                                                <td>{{ $event->spgOne->nama_lengkap }}</td>
                                                <td>{{ $event->spgTwo->nama_lengkap }}</td>
                                                <td>{{ $event->tanggal }}</td>
                                                <td>{{ $event->Sku->keterangan }}</td>
                                                <td>{{ number_format($event->qty, 0, ',', '.') }}</td>
                                                <td>{{ number_format($event->harga_satuan, 0, ',', '.') }}</td>
                                                <td>{{ number_format($event->total_penjualan, 0, ',', '.') }}</td>
                                                <td>{{ number_format($event->target_penjualan, 0, ',', '.') }}</td>
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
                "autoWidth": true,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        </script>
    </div>
@endsection
