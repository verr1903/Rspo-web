<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListKebun;

class ListKebunController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_kebun' => 'required|string|max:255',
        ]);

        ListKebun::create([
            'nama_kebun' => $request->nama_kebun,
        ]);

        return redirect()->back()->with('success', 'Data Nama Kebun berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kebun' => 'required|string|max:255',
        ]);

        $pks = ListKebun::findOrFail($id);
        $pks->update(['nama_kebun' => $request->nama_kebun]);

        return redirect()->route('dataList')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pks = ListKebun::findOrFail($id);
        $pks->delete();

        return redirect()->route('dataList')->with('success', 'Data berhasil dihapus!');
    }
}
