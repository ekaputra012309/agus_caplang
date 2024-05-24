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
                                <h3 class="card-title">Tambah Karyawan</h3>
                                {{-- <div class="card-tools">
                                    <a href="{{ route('karyawan.add') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Add Data
                                    </a>
                                </div> --}}
                            </div>
                            <form action="{{ route('karyawan.store') }}" method="POST">
                                @csrf
                                @auth
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @endauth

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nama_lengkap">Nama Karyawan</label>
                                                <input type="text" class="form-control" id="nama_lengkap"
                                                    name="nama_lengkap" placeholder="Nama Karyawan" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jabatan">Jabatan</label>
                                                <select name="jabatan" id="jabatan" class="form-control" required>
                                                    <option value="">Pilih</option>
                                                    <option value="TL">TL</option>
                                                    <option value="MD MT">MD MT</option>
                                                    <option value="MD GT">MD GT</option>
                                                    <option value="MD MINIES">MD MINIES</option>
                                                    <option value="SPG">SPG</option>
                                                    <option value="PACKER">PACKER</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
