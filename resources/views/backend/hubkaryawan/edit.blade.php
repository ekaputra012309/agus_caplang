@extends('backend/template/app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Karyawan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('hubkaryawan.index') }}">Karyawan</a></li>
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
                                <h3 class="card-title">Edit Karyawan</h3>
                            </div>
                            <form action="{{ route('hubkaryawan.update', $karyawan->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method for update -->
                                @auth
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @endauth

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="karyawan_id">Karyawan</label>
                                                <select name="karyawan_id" id="karyawan_id" class="form-control select2bs4"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    @foreach ($master_karyawan as $k)
                                                        <option value="{{ $k->id }}"
                                                            {{ $k->id == $karyawan->karyawan_id ? 'selected' : '' }}>
                                                            {{ $k->nama_lengkap }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nama_tl">Nama TL</label>
                                                <input type="text" class="form-control" id="nama_tl" name="nama_tl"
                                                    placeholder="Nama TL" required value="{{ $karyawan->nama_tl }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="area">Area</label>
                                                <input type="text" class="form-control" id="area" name="area"
                                                    placeholder="Area" required value="{{ $karyawan->area }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('hubkaryawan.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
