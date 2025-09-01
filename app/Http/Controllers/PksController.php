<?php

namespace App\Http\Controllers;

use App\Models\Pks;
use Illuminate\Http\Request;

class PksController extends Controller
{
    public function index()
    {
        // Ambil data dengan pagination (10 per halaman)
        $pks = Pks::select('tanggal_pengiriman', 'nama_pks', 'tujuan_pengiriman')
            ->paginate(10);

        // kirim ke view admin/rekapPks.blade.php
        return view('admin.rekapPks', compact('pks'));
    }
}
