<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterKategori;
use RealRashid\SweetAlert\Facades\Alert;

class MasterKategoriController extends Controller
{
    public function index()
    {
        $kategori = MasterKategori::all();
        $data = array(
            'title' => 'Kategori | ',
            'datakategori' => $kategori,
        );
        $title = 'Delete Kategori!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('backend.kategori.index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Add Kategori | ',
        );
        return view('backend.kategori.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        MasterKategori::create($request->all());
        Alert::success('Success', 'kategori created successfully.');

        return redirect()->route('kategori.index');
    }

    public function show(MasterKategori $kategori)
    {
        $data = array(
            'title' => 'View Kategori | ',
        );
        return view('backend.kategori.show', $data);
    }

    public function edit(MasterKategori $kategori)
    {
        $data = array(
            'title' => 'Edit Kategori | ',
            'MasterKategori' => $kategori,
        );
        return view('backend.kategori.edit', $data);
    }

    public function update(Request $request, MasterKategori $kategori)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $kategori->update($request->all());
        Alert::success('Success', 'kategori updated successfully.');

        return redirect()->route('kategori.index');
    }

    public function destroy(MasterKategori $kategori)
    {
        $kategori->delete();
        Alert::success('Success', 'kategori deleted successfully.');

        return redirect()->route('kategori.index');
    }
}
