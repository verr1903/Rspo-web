<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPks;

class ListPksController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pks' => 'required|string|max:255',
        ]);

        ListPks::create([
            'nama_pks' => $request->nama_pks,
        ]);

        return redirect()->back()->with('success', 'Data Nama PKS berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pks' => 'required|string|max:255',
        ]);

        $pks = ListPks::findOrFail($id);
        $pks->update(['nama_pks' => $request->nama_pks]);

        return redirect()->route('dataList')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pks = ListPks::findOrFail($id);
        $pks->delete();

        return redirect()->route('dataList')->with('success', 'Data berhasil dihapus!');
    }
}
