<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kebun extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_pengiriman',
        'nama_kebun',
        'afdeling',
        'nomor_blanko_pb25',
        'nopol_mobil',
        'nama_supir',
        'foto_keseluruhan_kebun',
        'foto_sebelum_kebun',
        'foto_sesudah_kebun'
    ];
}
