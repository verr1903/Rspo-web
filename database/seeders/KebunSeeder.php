<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kebun;

class KebunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kebun::create([
            'tanggal_pengiriman' => '2025-08-28',
            'nama_kebun' => 'Kebun Tandun',
            'afdeling' => 'Afdeling II',
            'nomor_blanko_pb25' => 'PB25-001',
            'nopol_mobil' => 'BM 1234 XY',
            'nama_supir' => 'Budi Santoso',
            'foto_keseluruhan_kebun' => 'foto_kendaraan_1.jpg',
            'foto_sebelum_kebun' => 'foto_kendaraan_2.jpg',
            'foto_sesudah_kebun' => 'foto_kendaraan_3.jpg',
        ]);
    }
}
