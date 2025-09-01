<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pks;

class PksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pks::create([
            'tanggal_pengiriman' => '2025-08-28',
            'nama_pks' => 'Pks Tandun',
            'tujuan_pengiriman' => 'PT. Wilmar Nabati Indonesia',
            'nomor_blanko_pb33' => 'PB33-001',
            'nopol_mobil' => 'BM 1234 XY',
            'nama_supir' => 'Budi Santoso',
            'foto_keseluruhan_pks' => 'foto_kendaraan_4.jpg',
            'foto_sebelum_pks' => 'foto_kendaraan_5.jpg',
            'foto_sesudah_pks' => 'foto_kendaraan_6.jpg',
        ]);
    }
}
