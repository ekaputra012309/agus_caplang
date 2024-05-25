<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EventModel;
use App\Models\KaryawanModel;
use App\Models\MasterHubkaryawan;
use App\Models\MasterSku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{
    public function index()
    {
        $event = EventModel::with('tl', 'spgOne', 'spgTwo', 'Sku')->get();
        $data = array(
            'title' => 'Event | ',
            'dataevent' => $event,
        );
        $title = 'Delete Event!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.event.index', $data);
    }

    public function create()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        if ($user->role == 'TL') {
            $karyawan = KaryawanModel::all();
            $karyawan_id = KaryawanModel::find($user->karyawan_id);
            $nama_lengkap = $karyawan_id->nama_lengkap;
            $spg = MasterHubkaryawan::with('karyawan')
                ->join('master_karyawan', 'master_hubkaryawan.karyawan_id', '=', 'master_karyawan.id')
                ->where('master_hubkaryawan.nama_tl', 'like', '%' . $nama_lengkap . '%')
                ->where('master_karyawan.jabatan', 'SPG')
                ->select('master_karyawan.*')
                ->get();
            $sku = MasterSku::where('kategori', 'VF')->get();
        } else {
            $karyawan = KaryawanModel::all();
            $spg = KaryawanModel::where('jabatan', 'SPG')->get();
            $sku = MasterSku::all();
        }

        $data = array(
            'title' => 'Add Event | ',
            'master_karyawan' => $karyawan,
            'karyawan_id' => $user->karyawan_id,
            'master_spg' => $spg,
            'master_sku' => $sku,
        );
        // echo json_encode($spg);
        // dd($data);
        return view('backend.event.create', $data);
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


        EventModel::create($request->all());
        Alert::success('Success', 'event created successfully.');

        return redirect()->route('event.index');
    }

    public function show(EventModel $event)
    {
        $data = array(
            'title' => 'View Event | ',
        );
        return view('backend.event.show', $data);
    }

    public function edit(EventModel $event)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        if ($user->role == 'TL') {
            $karyawan = KaryawanModel::all();
            $karyawan_id = KaryawanModel::find($user->karyawan_id);
            $nama_lengkap = $karyawan_id->nama_lengkap;
            $spg = MasterHubkaryawan::with('karyawan')
                ->join('master_karyawan', 'master_hubkaryawan.karyawan_id', '=', 'master_karyawan.id')
                ->where('master_hubkaryawan.nama_tl', 'like', '%' . $nama_lengkap . '%')
                ->where('master_karyawan.jabatan', 'SPG')
                ->select('master_karyawan.*')
                ->get();
            $sku = MasterSku::where('kategori', 'VF')->get();
        } else {
            $karyawan = KaryawanModel::all();
            $spg = KaryawanModel::where('jabatan', 'SPG')->get();
            $sku = MasterSku::all();
        }

        $data = array(
            'title' => 'Add Event | ',
            'master_karyawan' => $karyawan,
            'karyawan_id' => $user->karyawan_id,
            'master_spg' => $spg,
            'master_sku' => $sku,
            'event' => $event,
        );
        return view('backend.event.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $event = EventModel::find($id);
        if (!$event) {
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


        $event->update($request->all());
        Alert::success('Success', 'event updated successfully.');

        return redirect()->route('event.index');
    }

    public function destroy(EventModel $event)
    {
        $event->delete();
        Alert::success('Success', 'event deleted successfully.');

        return redirect()->route('event.index');
    }
}
