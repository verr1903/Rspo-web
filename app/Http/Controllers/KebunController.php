<?php

namespace App\Http\Controllers;

use App\Models\Kebun;
use Illuminate\Http\Request;

class KebunController extends Controller
{
    public function index()
    {
        // Ambil data dengan pagination (10 per halaman)
        $kebuns = Kebun::select('tanggal_pengiriman', 'nama_kebun', 'afdeling')
            ->paginate(10);

        // kirim ke view admin/rekapKebun.blade.php
        return view('admin.rekapKebun', compact('kebuns'));
    }
}
