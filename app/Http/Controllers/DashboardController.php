<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kebun;
use App\Models\Pks;

class DashboardController extends Controller
{
    public function index()
    {
        // Total data
        $totalKebun = Kebun::count();
        $totalPks   = Pks::count();

        // Data Minggu (7 hari terakhir)
        $mingguKebun = Kebun::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal');

        $mingguPks = Pks::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal');

        // Data Bulan (12 bulan di tahun ini)
        $bulanKebun = Kebun::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $bulanPks = Pks::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        return view('admin.index', [
            'title'        => 'Dashboard',
            'totalKebun'   => $totalKebun,
            'totalPks'     => $totalPks,
            'mingguKebun'  => $mingguKebun,
            'mingguPks'    => $mingguPks,
            'bulanKebun'   => $bulanKebun,
            'bulanPks'     => $bulanPks,
        ]);
    }
}
