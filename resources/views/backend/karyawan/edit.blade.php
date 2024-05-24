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
                            <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Karyawan</a></li>
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
                            <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method for update -->
                                @auth
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @endauth

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nama_lengkap">Nama Karyawan</label>
                                                <input type="text" class="form-control" id="nama_lengkap"
                                                    name="nama_lengkap" placeholder="Nama Karyawan" required
                                                    value="{{ $karyawan->nama_lengkap }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jabatan">Jabatan</label>
                                                <select name="jabatan" id="jabatan" class="form-control" required>
                                                    <option value="">Pilih</option>
                                                    <option value="TL"
                                                        {{ $karyawan->jabatan == 'TL' ? 'selected' : '' }}>TL
                                                    </option>
                                                    <option value="MD MT"
                                                        {{ $karyawan->jabatan == 'MD MT' ? 'selected' : '' }}>MD MT</option>
                                                    <option value="MD GT"
                                                        {{ $karyawan->jabatan == 'MD GT' ? 'selected' : '' }}>MD GT</option>
                                                    <option value="MD MINIES"
                                                        {{ $karyawan->jabatan == 'MD MINIES' ? 'selected' : '' }}>MD MINIES
                                                    </option>
                                                    <option value="SPG"
                                                        {{ $karyawan->jabatan == 'SPG' ? 'selected' : '' }}>
                                                        SPG</option>
                                                    <option value="PACKER"
                                                        {{ $karyawan->jabatan == 'PACKER' ? 'selected' : '' }}>
                                                        PACKER</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
