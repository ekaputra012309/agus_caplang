<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KaryawanModel;
use App\Models\MasterHubkaryawan;
use App\Models\MasterOutlet;
use App\Models\MasterSku;
use App\Models\MasterStok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MasterStokController extends Controller
{
    public function index()
    {
        $stok = MasterStok::with('spg', 'outlet', 'Sku')
            ->join('master_hubkaryawan', 'master_hubkaryawan.karyawan_id', '=', 'table_master_stok.spg_id')
            ->select('table_master_stok.*', 'master_hubkaryawan.nama_tl as nama_tl')
            ->where('table_master_stok.user_id', '=', Auth::id())
            ->get();
        $data = array(
            'title' => 'Stok | ',
            'datastok' => $stok,
        );
        $title = 'Delete Stok!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.stok.index', $data);
    }

    public function create()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        if ($user->role == 'SPG') {
            $karyawan = KaryawanModel::all();
            $tl = MasterHubkaryawan::with('karyawan')
                ->join('master_karyawan', 'master_hubkaryawan.karyawan_id', '=', 'master_karyawan.id')
                ->where('master_hubkaryawan.karyawan_id', '=', $user->karyawan_id)
                ->select('master_karyawan.*', 'master_hubkaryawan.area as area')
                ->first();
            $spg = KaryawanModel::where('id', '=', $tl->karyawan_id)->get();
            $outlet = MasterOutlet::with('area')
                ->join('master_area_outlet', 'master_outlet.area_id', '=', 'master_area_outlet.id')
                ->where('master_area_outlet.area', 'like', '%' . $tl->area . '%')
                ->select('master_outlet.id as kode', 'master_outlet.outlet as outlet')
                ->get();
            $area = $tl->area;
        } else {
            $tl = KaryawanModel::where('jabatan', 'TL')->get();
            $spg = KaryawanModel::where('jabatan', 'SPG')->get();
            $outlet = MasterOutlet::all();
            $area = '';
        }

        $data = array(
            'title' => 'Add Stok | ',
            'master_karyawan' => $karyawan,
            'karyawan_id' => $user->karyawan_id,
            'master_spg' => $spg,
            'master_sku' => [],  // Initially empty, will be loaded via AJAX
            'master_outlet' => $outlet,
            'area' => $area,
        );

        return view('backend.stok.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'spg_id' => 'required|exists:master_karyawan,id',
            'area' => 'required|string|max:255',
            'outlet_id' => 'required|exists:master_outlet,id',
            'sku' => 'required|exists:master_sku,id',
            'stok' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);


        MasterStok::create($request->all());
        Alert::success('Success', 'stok created successfully.');

        return redirect()->route('stok.index');
    }

    public function show(MasterStok $stok)
    {
        $data = array(
            'title' => 'View Stok | ',
        );
        return view('backend.stok.show', $data);
    }

    public function edit(MasterStok $stok)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        if ($user->role == 'SPG') {
            $karyawan = KaryawanModel::all();
            $tl = MasterHubkaryawan::with('karyawan')
                ->join('master_karyawan', 'master_hubkaryawan.karyawan_id', '=', 'master_karyawan.id')
                ->where('master_hubkaryawan.karyawan_id', '=', $user->karyawan_id)
                ->select('master_karyawan.*', 'master_hubkaryawan.area as area')
                ->first();
            $spg = KaryawanModel::where('id', '=', $tl->karyawan_id)->get();
            $outlet = MasterOutlet::with('area')
                ->join('master_area_outlet', 'master_outlet.area_id', '=', 'master_area_outlet.id')
                ->where('master_area_outlet.area', 'like', '%' . $tl->area . '%')
                ->select('master_outlet.id as kode', 'master_outlet.outlet as outlet')
                ->get();
            $area = $tl->area;
            $sku = MasterSku::all();
        } else {
            $tl = KaryawanModel::where('jabatan', 'TL')->get();
            $spg = KaryawanModel::where('jabatan', 'SPG')->get();
            $outlet = MasterOutlet::all();
            $area = '';
        }

        $data = array(
            'title' => 'Add Stok | ',
            'master_karyawan' => $karyawan,
            'karyawan_id' => $user->karyawan_id,
            'master_spg' => $spg,
            'master_sku' => $sku,  // Initially empty, will be loaded via AJAX
            'master_outlet' => $outlet,
            'area' => $area,
            'stockEntry' => $stok,
        );

        return view('backend.stok.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $stok = MasterStok::find($id);
        if (!$stok) {
            Alert::error('Error', 'Model not found.');
        }
        $request->validate([
            'spg_id' => 'required|exists:master_karyawan,id',
            'area' => 'required|string|max:255',
            'outlet_id' => 'required|exists:master_outlet,id',
            'sku' => 'required|exists:master_sku,id',
            'stok' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);

        // dd($request->all());
        $stok->update($request->all());
        Alert::success('Success', 'stok updated successfully.');

        return redirect()->route('stok.index');
    }

    public function destroy(MasterStok $stok)
    {
        $stok->delete();
        Alert::success('Success', 'stok deleted successfully.');

        return redirect()->route('stok.index');
    }

    public function getFilteredSkus(Request $request)
    {
        $outlet_id = $request->input('outlet_id');

        $existingSkus = MasterStok::where('outlet_id', $outlet_id)->pluck('sku');
        $skus = MasterSku::whereNotIn('id', $existingSkus)->get();

        return response()->json($skus);
    }
}
