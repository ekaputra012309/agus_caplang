<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterSku;
use RealRashid\SweetAlert\Facades\Alert;

class MasterSkuController extends Controller
{
    public function index()
    {
        $sku = MasterSku::with('brand1', 'kategori1')->get();
        $data = array(
            'title' => 'SKU | ',
            'datasku' => $sku,
        );
        $title = 'Delete SKU!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.sku.index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Add SKU | ',
        );
        return view('backend.sku.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        MasterSku::create($request->all());
        Alert::success('Success', 'sku created successfully.');

        return redirect()->route('sku.index');
    }

    public function show(MasterSku $sku)
    {
        $data = array(
            'title' => 'View SKU | ',
        );
        return view('backend.sku.show', $data);
    }

    public function edit(MasterSku $sku)
    {
        $data = array(
            'title' => 'Edit SKU | ',
            'masterSku' => $sku,
        );
        return view('backend.sku.edit', $data);
    }

    public function update(Request $request, MasterSku $sku)
    {
        $request->validate([
            'sku' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $sku->update($request->all());
        Alert::success('Success', 'sku updated successfully.');

        return redirect()->route('sku.index');
    }

    public function destroy(MasterSku $sku)
    {
        $sku->delete();
        Alert::success('Success', 'sku deleted successfully.');

        return redirect()->route('sku.index');
    }
}
