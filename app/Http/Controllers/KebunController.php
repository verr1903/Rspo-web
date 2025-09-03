<?php

namespace App\Http\Controllers;

use App\Models\Kebun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\RekapKebunExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ListKebun;
use App\Models\ListAfdeling;
use Barryvdh\DomPDF\Facade\Pdf;

class KebunController extends Controller
{
    public function index(Request $request)
    {
        $namaKebuns = Kebun::select('nama_kebun')
            ->distinct()
            ->orderBy('nama_kebun')
            ->pluck('nama_kebun');

        $query = Kebun::query();

        if ($request->filled('startDate')) {
            $query->where('tanggal_pengiriman', '>=', $request->startDate);
        }

        if ($request->filled('endDate')) {
            $query->where('tanggal_pengiriman', '<=', $request->endDate);
        }

        if ($request->filled('namaKebun')) {
            $query->where('nama_kebun', $request->namaKebun);
        }

        $kebuns = $query->paginate(10)->withQueryString();

        // 🔹 ambil list kebun & afdeling untuk dropdown edit
        $listKebuns = ListKebun::orderBy('nama_kebun')->get();
        $listAfdelings = ListAfdeling::orderBy('afdeling')->get();

        return view('admin.rekapKebun', [
            'title' => 'Rekap Kebun',
            'kebuns' => $kebuns,
            'namaKebuns' => $namaKebuns,
            'listKebuns' => $listKebuns,
            'listAfdelings' => $listAfdelings,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tanggal_pengiriman' => 'required|date',
            'nama_kebun'         => 'required|string|max:255',
            'afdeling'           => 'required|string|max:255',
            'nomor_blanko_pb25'  => 'required|string|max:255',
            'nopol_mobil'        => 'required|string|max:255',
            'nama_supir'         => 'required|string|max:255',
            'gambar1'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar2'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar3'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Cari data
        $kebun = Kebun::findOrFail($id);

        // Update field biasa
        $kebun->tanggal_pengiriman = $validatedData['tanggal_pengiriman'];
        $kebun->nama_kebun         = $validatedData['nama_kebun'];
        $kebun->afdeling           = $validatedData['afdeling'];
        $kebun->nomor_blanko_pb25  = $validatedData['nomor_blanko_pb25'];
        $kebun->nopol_mobil        = $validatedData['nopol_mobil'];
        $kebun->nama_supir         = $validatedData['nama_supir'];

        // Update gambar 1
        if ($request->hasFile('gambar1')) {
            if ($kebun->foto_keseluruhan_kebun) {
                Storage::disk('public')->delete($kebun->foto_keseluruhan_kebun);
            }
            $path = $request->file('gambar1')->store('kebun', 'public');
            $kebun->foto_keseluruhan_kebun = $path;
        }

        // Update gambar 2
        if ($request->hasFile('gambar2')) {
            if ($kebun->foto_sebelum_kebun) {
                Storage::disk('public')->delete($kebun->foto_sebelum_kebun);
            }
            $path = $request->file('gambar2')->store('kebun', 'public');
            $kebun->foto_sebelum_kebun = $path;
        }

        // Update gambar 3
        if ($request->hasFile('gambar3')) {
            if ($kebun->foto_sesudah_kebun) {
                Storage::disk('public')->delete($kebun->foto_sesudah_kebun);
            }
            $path = $request->file('gambar3')->store('kebun', 'public');
            $kebun->foto_sesudah_kebun = $path;
        }

        // Simpan perubahan
        $kebun->save();

        return redirect()->route('kebun')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kebun = Kebun::findOrFail($id);

        // Hapus gambar jika ada
        if ($kebun->foto_keseluruhan_kebun) {
            Storage::disk('public')->delete($kebun->foto_keseluruhan_kebun);
        }
        if ($kebun->foto_sebelum_kebun) {
            Storage::disk('public')->delete($kebun->foto_sebelum_kebun);
        }
        if ($kebun->foto_sesudah_kebun) {
            Storage::disk('public')->delete($kebun->foto_sesudah_kebun);
        }

        // Hapus data
        $kebun->delete();

        return redirect()->route('kebun')->with('success', 'Data berhasil dihapus!');
    }

    public function exportExcel(Request $request)
    {
        $query = Kebun::query();

        if ($request->filled('startDate')) {
            $query->where('tanggal_pengiriman', '>=', $request->startDate);
        }

        if ($request->filled('endDate')) {
            $query->where('tanggal_pengiriman', '<=', $request->endDate);
        }

        if ($request->filled('namaKebun')) {
            $query->where('nama_kebun', $request->namaKebun);
        }

        $rows = $query->get(); // <-- ambil semua data tanpa paginate
        return Excel::download(new RekapKebunExport($rows), 'rekap_kebun.xlsx');
    }

    public function exportPDFPerKebun($id)
    {
        $kebun = Kebun::findOrFail($id);

        $pdf = PDF::loadView('pdf.kebun', compact('kebun'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('rekap_kebun_' . $kebun->id . '.pdf');
    }
}
