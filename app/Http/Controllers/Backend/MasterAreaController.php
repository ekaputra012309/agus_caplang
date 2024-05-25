<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MasterArea;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterAreaController extends Controller
{
    public function index()
    {
        $area = MasterArea::all();
        $data = array(
            'title' => 'Area | ',
            'dataarea' => $area,
        );
        $title = 'Delete Area!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.area.index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Add Area | ',
        );
        return view('backend.area.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        MasterArea::create($request->all());
        Alert::success('Success', 'area created successfully.');

        return redirect()->route('area.index');
    }

    public function show(MasterArea $area)
    {
        $data = array(
            'title' => 'View Area | ',
        );
        return view('backend.area.show', $data);
    }

    public function edit(MasterArea $area)
    {
        $data = array(
            'title' => 'Edit Area | ',
            'area' => $area,
        );
        return view('backend.area.edit', $data);
    }

    public function update(Request $request, MasterArea $area)
    {
        $request->validate([
            'area' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        $area->update($request->all());
        Alert::success('Success', 'area updated successfully.');

        return redirect()->route('area.index');
    }

    public function destroy(MasterArea $area)
    {
        $area->delete();
        Alert::success('Success', 'area deleted successfully.');

        return redirect()->route('area.index');
    }
}
