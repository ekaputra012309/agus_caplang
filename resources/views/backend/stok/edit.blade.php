@extends('backend/template/app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Stock Entry</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('stok.index') }}">Stock Entries</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                                <h3 class="card-title">Edit Stock Entry</h3>
                            </div>
                            <form action="{{ route('stok.update', $stockEntry->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @auth
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @endauth

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="spg_id">Nama SPG</label>
                                                <select name="spg_id" id="spg_id"
                                                    class="form-control {{ auth()->user()->role != 'SPG' ? 'select2bs4' : '' }}"
                                                    required {{ auth()->user()->role == 'SPG' ? 'readonly' : '' }}>
                                                    @foreach ($master_karyawan as $k)
                                                        <option value="{{ $k->id }}"
                                                            {{ $stockEntry->spg_id == $k->id ? 'selected' : '' }}>
                                                            {{ $k->nama_lengkap }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="area">Area</label>
                                                <input type="text" class="form-control" id="area" name="area"
                                                    required value="{{ $stockEntry->area }}"
                                                    {{ auth()->user()->role == 'SPG' ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="outlet_id">Outlet</label>
                                                <select name="outlet_id" id="outlet_id" class="form-control select2bs4"
                                                    required>
                                                    @foreach ($master_outlet as $o)
                                                        <option value="{{ $o->kode }}"
                                                            {{ $stockEntry->outlet_id == $o->kode ? 'selected' : '' }}>
                                                            {{ $o->outlet }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sku">SKU</label>
                                                <select name="sku" id="sku" class="form-control select2bs4"
                                                    required>
                                                    @foreach ($master_sku as $s)
                                                        <option value="{{ $s->id }}"
                                                            {{ $stockEntry->sku == $s->id ? 'selected' : '' }}>
                                                            {{ $s->keterangan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stok">Stock Quantity</label>
                                                <input type="number" class="form-control" id="stok" name="stok"
                                                    required value="{{ $stockEntry->stok }}"
                                                    {{ auth()->user()->role == 'SPG' ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('stok.index') }}" class="btn btn-secondary">Back</a>
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
                });

                $('#outlet_id').change(function() {
                    var outlet_id = $(this).val();
                    console.log('Selected Outlet ID:', outlet_id);

                    if (outlet_id) {
                        $.ajax({
                            url: '{{ route('getFilteredSkus') }}',
                            type: 'GET',
                            data: {
                                outlet_id: outlet_id
                            },
                            success: function(data) {
                                console.log('Response Data:', data);
                                $('#sku').empty();
                                if (data.length > 0) {
                                    $.each(data, function(index, sku) {
                                        $('#sku').append('<option value="' + sku.id + '">' +
                                            sku.keterangan + '</option>');
                                    });
                                } else {
                                    $('#sku').append('<option value="">No SKUs available</option>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', error);
                            }
                        });
                    } else {
                        $('#sku').empty().append('<option value="">Select an outlet first</option>');
                    }
                });
            });
        </script>
    </div>
@endsection
