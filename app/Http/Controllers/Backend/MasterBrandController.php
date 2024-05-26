<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterBrand;
use RealRashid\SweetAlert\Facades\Alert;

class MasterBrandController extends Controller
{
    public function index()
    {
        $brand = MasterBrand::all();
        $data = array(
            'title' => 'Brand | ',
            'databrand' => $brand,
        );
        $title = 'Delete Brand!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.brand.index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Add Brand | ',
        );
        return view('backend.brand.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_brand' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        MasterBrand::create($request->all());
        Alert::success('Success', 'brand created successfully.');

        return redirect()->route('brand.index');
    }

    public function show(MasterBrand $brand)
    {
        $data = array(
            'title' => 'View Brand | ',
        );
        return view('backend.brand.show', $data);
    }

    public function edit(MasterBrand $brand)
    {
        $data = array(
            'title' => 'Edit Brand | ',
            'MasterBrand' => $brand,
        );
        return view('backend.brand.edit', $data);
    }

    public function update(Request $request, MasterBrand $brand)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $brand->update($request->all());
        Alert::success('Success', 'brand updated successfully.');

        return redirect()->route('brand.index');
    }

    public function destroy(MasterBrand $brand)
    {
        $brand->delete();
        Alert::success('Success', 'brand deleted successfully.');

        return redirect()->route('brand.index');
    }
}
