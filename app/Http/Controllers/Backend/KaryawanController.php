<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KaryawanModel;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = KaryawanModel::all();
        $data = array(
            'title' => 'Karyawan | ',
            'datakaryawan' => $karyawan,
        );
        $title = 'Delete Karyawan!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.karyawan.index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Add Karyawan | ',
        );
        return view('backend.karyawan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'jabatan' => 'required|string|max:50',
        ]);

        KaryawanModel::create($request->all());
        Alert::success('Success', 'karyawan created successfully.');

        return redirect()->route('karyawan.index');
    }

    public function show(KaryawanModel $karyawan)
    {
        $data = array(
            'title' => 'View karyawan | ',
        );
        return view('backend.karyawan.show', $data);
    }

    public function edit(KaryawanModel $karyawan)
    {
        $data = array(
            'title' => 'Edit Karyawan | ',
            'karyawan' => $karyawan,
        );
        return view('backend.karyawan.edit', $data);
    }

    public function update(Request $request, KaryawanModel $karyawan)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'jabatan' => 'required|string|max:50',
        ]);

        $karyawan->update($request->all());
        Alert::success('Success', 'karyawan updated successfully.');

        return redirect()->route('karyawan.index');
    }

    public function destroy(KaryawanModel $karyawan)
    {
        $karyawan->delete();
        Alert::success('Success', 'karyawan deleted successfully.');

        return redirect()->route('karyawan.index');
    }
}
