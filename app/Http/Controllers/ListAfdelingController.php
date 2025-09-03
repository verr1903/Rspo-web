<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListAfdeling;

class ListAfdelingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'afdeling' => 'required|string|max:255',
        ]);

        ListAfdeling::create([
            'afdeling' => $request->afdeling,
        ]);

        return redirect()->back()->with('success', 'Data Afdeling berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'afdeling' => 'required|string|max:255',
        ]);

        $pks = ListAfdeling::findOrFail($id);
        $pks->update(['afdeling' => $request->afdeling]);

        return redirect()->route('dataList')->with('success', 'Data berhasil Diubah!');
    }

    public function destroy($id)
    {
        $pks = ListAfdeling::findOrFail($id);
        $pks->delete();

        return redirect()->route('dataList')->with('success', 'Data berhasil diperbarui!');
    }
}
