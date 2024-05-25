<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KaryawanModel;
use App\Models\MasterHubkaryawan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HubkaryawanController extends Controller
{
    public function index()
    {
        $hubkaryawan = MasterHubkaryawan::with('karyawan')->get();
        $data = array(
            'title' => 'Karyawan | ',
            'datakaryawan' => $hubkaryawan,
        );
        $title = 'Delete Karyawan!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.hubkaryawan.index', $data);
    }

    public function create()
    {
        $master = KaryawanModel::all();
        $data = array(
            'title' => 'Add Karyawan | ',
            'master_karyawan' => $master,
        );
        return view('backend.hubkaryawan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tl' => 'required|exists:master_karyawan,id',
            'spg1' => 'required|exists:master_karyawan,id',
            'spg2' => 'required|exists:master_karyawan,id',
            'tanggal' => 'required|date',
            'sku' => 'required|exists:master_sku,id',
            'qty' => 'required|integer',
            'harga_satuan' => 'required|integer',
            'total_penjualan' => 'required|integer',
            'target_penjualan' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);


        MasterHubkaryawan::create($request->all());
        Alert::success('Success', 'karyawan created successfully.');

        return redirect()->route('hubkaryawan.index');
    }

    public function show(MasterHubkaryawan $hubkaryawan)
    {
        $data = array(
            'title' => 'View karyawan | ',
        );
        return view('backend.hubkaryawan.show', $data);
    }

    public function edit(MasterHubkaryawan $hubkaryawan)
    {
        $master = KaryawanModel::all();
        $data = array(
            'title' => 'Edit Karyawan | ',
            'karyawan' => $hubkaryawan,
            'master_karyawan' => $master,
        );
        return view('backend.hubkaryawan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $hubkaryawan = MasterHubkaryawan::find($id);
        if (!$hubkaryawan) {
            Alert::error('Error', 'Model not found.');
        }
        $request->validate([
            'nama_tl' => 'required|exists:master_karyawan,id',
            'spg1' => 'required|exists:master_karyawan,id',
            'spg2' => 'required|exists:master_karyawan,id',
            'tanggal' => 'required|date',
            'sku' => 'required|exists:master_sku,id',
            'qty' => 'required|integer',
            'harga_satuan' => 'required|integer',
            'total_penjualan' => 'required|integer',
            'target_penjualan' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);


        $hubkaryawan->update($request->all());
        Alert::success('Success', 'karyawan updated successfully.');

        return redirect()->route('hubkaryawan.index');
    }

    public function destroy(MasterHubkaryawan $hubkaryawan)
    {
        $hubkaryawan->delete();
        Alert::success('Success', 'karyawan deleted successfully.');

        return redirect()->route('hubkaryawan.index');
    }
}
