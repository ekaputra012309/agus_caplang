<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MasterArea;
use App\Models\MasterOutlet;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterOutletController extends Controller
{
    public function index()
    {
        $outlet = MasterOutlet::with('area')->get();
        $data = array(
            'title' => 'Outlet | ',
            'dataoutlet' => $outlet,
        );
        $title = 'Delete Outlet!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.outlet.index', $data);
    }

    public function create()
    {
        $area = MasterArea::all();
        $data = array(
            'title' => 'Add Outlet | ',
            'master_area' => $area,
        );
        return view('backend.outlet.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'outlet' => 'required|string',
            'area_id' => 'required|exists:master_area_outlet,id',
            'user_id' => 'required|exists:users,id'
        ]);

        MasterOutlet::create($request->all());
        Alert::success('Success', 'outlet created successfully.');

        return redirect()->route('outlet.index');
    }

    public function show(MasterOutlet $outlet)
    {
        $data = array(
            'title' => 'View Outlet | ',
        );
        return view('backend.outlet.show', $data);
    }

    public function edit(MasterOutlet $outlet)
    {
        $area = MasterArea::all();
        $data = array(
            'title' => 'Edit Outlet | ',
            'outlet' => $outlet,
            'master_area' => $area,
        );
        return view('backend.outlet.edit', $data);
    }

    public function update(Request $request, MasterOutlet $outlet)
    {
        $request->validate([
            'outlet' => 'required|string',
            'area_id' => 'required|exists:master_area_outlet,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $outlet->update($request->all());
        Alert::success('Success', 'outlet updated successfully.');

        return redirect()->route('outlet.index');
    }

    public function destroy(MasterOutlet $outlet)
    {
        $outlet->delete();
        Alert::success('Success', 'outlet deleted successfully.');

        return redirect()->route('outlet.index');
    }
}
