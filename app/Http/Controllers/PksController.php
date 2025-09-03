<?php

namespace App\Http\Controllers;

use App\Models\Pks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\RekapPksExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ListPks;
use Barryvdh\DomPDF\Facade\Pdf;


class PksController extends Controller
{
    public function index(Request $request)
    {
        $namaPkss = Pks::select('nama_pks')
            ->distinct()
            ->orderBy('nama_pks')
            ->pluck('nama_pks');

        $query = Pks::query();

        if ($request->filled('startDate')) {
            $query->where('tanggal_pengiriman', '>=', $request->startDate);
        }

        if ($request->filled('endDate')) {
            $query->where('tanggal_pengiriman', '<=', $request->endDate);
        }

        if ($request->filled('namaPks')) {
            $query->where('nama_pks', $request->namaPks);
        }

        $pkss = $query->paginate(10)->withQueryString();

        // 🔹 ambil list Pks & afdeling untuk dropdown edit
        $listPks = ListPks::orderBy('nama_pks')->get();

        return view('admin.rekapPks', [
            'title' => 'Rekap Pks',
            'pkss' => $pkss,
            'namaPkss' => $namaPkss,
            'listPks' => $listPks,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tanggal_pengiriman' => 'required|date',
            'nama_pks'           => 'required|string|max:255',
            'tujuan_pengiriman'  => 'required|string|max:255',
            'nomor_blanko_pb33'  => 'required|string|max:255',
            'nopol_mobil'        => 'required|string|max:255',
            'nama_supir'         => 'required|string|max:255',
            'gambar1'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar2'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar3'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Cari data
        $pks = Pks::findOrFail($id);

        // Update field biasa
        $pks->tanggal_pengiriman = $validatedData['tanggal_pengiriman'];
        $pks->nama_pks           = $validatedData['nama_pks'];
        $pks->tujuan_pengiriman  = $validatedData['tujuan_pengiriman'];
        $pks->nomor_blanko_pb33  = $validatedData['nomor_blanko_pb33'];
        $pks->nopol_mobil        = $validatedData['nopol_mobil'];
        $pks->nama_supir         = $validatedData['nama_supir'];

        // Update gambar 1
        if ($request->hasFile('gambar1')) {
            if ($pks->foto_keseluruhan_pks) {
                Storage::disk('public')->delete($pks->foto_keseluruhan_pks);
            }
            $path = $request->file('gambar1')->store('pks', 'public');
            $pks->foto_keseluruhan_pks = $path;
        }

        // Update gambar 2
        if ($request->hasFile('gambar2')) {
            if ($pks->foto_sebelum_pks) {
                Storage::disk('public')->delete($pks->foto_sebelum_pks);
            }
            $path = $request->file('gambar2')->store('pks', 'public');
            $pks->foto_sebelum_pks = $path;
        }

        // Update gambar 3
        if ($request->hasFile('gambar3')) {
            if ($pks->foto_sesudah_pks) {
                Storage::disk('public')->delete($pks->foto_sesudah_pks);
            }
            $path = $request->file('gambar3')->store('pks', 'public');
            $pks->foto_sesudah_pks = $path;
        }

        // Simpan perubahan
        $pks->save();

        return redirect()->route('pks')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pks = Pks::findOrFail($id);

        // Hapus gambar jika ada
        if ($pks->foto_keseluruhan_pks) {
            Storage::disk('public')->delete($pks->foto_keseluruhan_pks);
        }
        if ($pks->foto_sebelum_pks) {
            Storage::disk('public')->delete($pks->foto_sebelum_pks);
        }
        if ($pks->foto_sesudah_pks) {
            Storage::disk('public')->delete($pks->foto_sesudah_pks);
        }

        // Hapus data
        $pks->delete();

        return redirect()->route('pks')->with('success', 'Data berhasil dihapus!');
    }

    public function exportExcel(Request $request)
    {
        $query = Pks::query();

        if ($request->filled('startDate')) {
            $query->where('tanggal_pengiriman', '>=', $request->startDate);
        }

        if ($request->filled('endDate')) {
            $query->where('tanggal_pengiriman', '<=', $request->endDate);
        }

        if ($request->filled('namaPks')) {
            $query->where('nama_pks', $request->namaPks);
        }

        $rows = $query->get(); // <-- ambil semua data tanpa paginate
        return Excel::download(new RekapPksExport($rows), 'rekap_pks.xlsx');
    }

    public function exportPDFPerPks($id)
    {
        $pks = Pks::findOrFail($id);

        $pdf = PDF::loadView('pdf.pks', compact('pks'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('rekap_pks_' . $pks->id . '.pdf');
    }
}
