@extends('backend/template/app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Stock Entry</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('stok.index') }}">Stock Entries</a></li>
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
                                <h3 class="card-title">Add Stock Entry</h3>
                            </div>
                            <form action="{{ route('stok.store') }}" method="POST">
                                @csrf
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
                                                            {{ $karyawan_id == $k->id ? 'selected' : '' }}>
                                                            {{ $k->nama_lengkap }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="area">Area</label>
                                                <input type="text" class="form-control" id="area" name="area"
                                                    required value="{{ $area }}"
                                                    {{ auth()->user()->role == 'SPG' ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="outlet_id">Outlet</label>
                                                <select name="outlet_id" id="outlet_id" class="form-control select2bs4"
                                                    required>
                                                    <option value="">Select Outlet</option>
                                                    @foreach ($master_outlet as $o)
                                                        <option value="{{ $o->kode }}">{{ $o->outlet }}</option>
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
                                                    <!-- Options will be populated via AJAX -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stok">Stock Quantity</label>
                                                <input type="number" class="form-control" id="stok" name="stok"
                                                    required value="0"
                                                    {{ auth()->user()->role == 'SPG' ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
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
