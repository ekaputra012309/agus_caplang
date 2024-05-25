@extends('backend/template/app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Event</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Events</a></li>
                            <li class="breadcrumb-item active">Add</li>
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
                                <h3 class="card-title">Tambah Event</h3>
                            </div>
                            <form action="{{ route('event.store') }}" method="POST">
                                @csrf
                                @auth
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @endauth

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nama_tl">Nama TL</label>
                                                <select name="nama_tl" id="nama_tl"
                                                    class="form-control {{ auth()->user()->role != 'TL' ? 'select2bs4' : '' }}"
                                                    required {{ auth()->user()->role == 'TL' ? 'readonly' : '' }}>
                                                    {{-- <option value="">Pilih</option> --}}
                                                    @foreach ($master_karyawan as $k)
                                                        <option value="{{ $k->id }}"
                                                            {{ $k->id == $karyawan_id ? 'selected' : '' }}>
                                                            {{ $k->nama_lengkap }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="spg1">SPG 1</label>
                                                <select name="spg1" id="spg1"
                                                    class="form-control {{ auth()->user()->role != 'TL' ? 'select2bs4' : '' }}"
                                                    required>
                                                    {{-- <option value="">Pilih</option> --}}
                                                    @foreach ($master_spg as $k)
                                                        <option value="{{ $k->id }}">{{ $k->nama_lengkap }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="spg2">SPG 2</label>
                                                <select name="spg2" id="spg2"
                                                    class="form-control {{ auth()->user()->role != 'TL' ? 'select2bs4' : '' }}"
                                                    required>
                                                    {{-- <option value="">Pilih</option> --}}
                                                    @foreach ($master_spg as $k)
                                                        <option value="{{ $k->id }}">{{ $k->nama_lengkap }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sku">SKU</label>
                                                <select name="sku" id="sku"
                                                    class="form-control {{ auth()->user()->role != 'TL' ? 'select2bs4' : '' }}"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    @foreach ($master_sku as $s)
                                                        <option value="{{ $s->id }}">{{ $s->keterangan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="qty">Quantity</label>
                                                <input type="number" class="form-control" id="qty" name="qty"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="harga_satuan">Harga Satuan</label>
                                                <input type="text" class="form-control" id="harga_satuan_view" readonly
                                                    value="10.000">
                                                <input type="hidden" class="form-control" id="harga_satuan"
                                                    name="harga_satuan" value="10000">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="total_penjualan">Total Penjualan</label>
                                                <input type="text" class="form-control" id="total_penjualan_view"
                                                    readonly value="0">
                                                <input type="hidden" class="form-control" id="total_penjualan"
                                                    name="total_penjualan" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="target_penjualan">Target Penjualan</label>
                                                <input type="text" class="form-control" id="target_penjualan_view"
                                                    name="target_penjualan" required>
                                                <input type="hidden" class="form-control" id="target_penjualan_hidden"
                                                    name="target_penjualan" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    <a href="{{ route('event.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            $(function() {
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
            });
        </script>
        <script>
            $(document).ready(function() {

                function formatNumber(num) {
                    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }

                function calculateTotalPenjualan() {
                    let qty = parseInt($('#qty').val());
                    let harga_satuan = parseInt($('#harga_satuan').val());

                    if (isNaN(qty) || isNaN(harga_satuan)) {
                        $('#total_penjualan').val('');
                        $('#total_penjualan_view').val('');
                    } else {
                        let total_penjualan = qty * harga_satuan;
                        $('#total_penjualan').val(total_penjualan);
                        $('#total_penjualan_view').val(formatNumber(total_penjualan));
                    }
                }

                $('#qty').on('input', function() {
                    calculateTotalPenjualan();
                });

                $('#target_penjualan_view').on('input', function() {
                    let target_penjualan = $(this).val().replace(/\./g, '');
                    $('#target_penjualan_hidden').val(target_penjualan);
                    $(this).val(formatNumber(target_penjualan));
                });

                // Initial calculation
                calculateTotalPenjualan();
            });
        </script>

    </div>
@endsection
