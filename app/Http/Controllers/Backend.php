<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Backend extends Controller
{
    public function signin()
    {
        $data = array(
            'title' => 'Login | ',
        );
        return view('backend.login', $data);
    }

    public function register()
    {
        $data = array(
            'title' => 'Register | ',
        );
        return view('backend.register', $data);
    }

    public function dashboard()
    {
        $totalvsTarget = EventModel::selectRaw(
            'master_sku.keterangan AS sku_keterangan,
        SUM(table_event.total_penjualan) AS total_penjualan,
        SUM(table_event.target_penjualan) AS target_penjualan'
        )
            ->join('master_sku', 'table_event.sku', '=', 'master_sku.id')
            ->groupBy('table_event.sku')
            ->get();

        $totalbySku = EventModel::selectRaw(
            'table_event.sku,
            master_sku.keterangan AS nama_sku,
            SUM(total_penjualan) as total_penjualan'
        )
            ->join('master_sku', 'master_sku.id', '=', 'table_event.sku')
            ->groupBy('sku')
            ->orderBy('nama_sku', 'asc')
            ->get();
        $data = [
            'title' => 'Dashboard | ',
            'totalbySku' => $totalbySku,
            'totalvsTarget' => $totalvsTarget,
        ];

        return view('backend.dashboard', $data);
    }

    public function profile(Request $request)
    {
        $data = array(
            'title' => 'Profile | ',
            'user' => $request->user(),
        );
        return view('backend.profile', $data);
    }
}
