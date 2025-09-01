<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pks extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_pengiriman',
        'nama_pks',
        'tujuan_pengiriman',
        'nomor_blanko_pb33',
        'nopol_mobil',
        'nama_supir',
        'foto_keseluruhan_pks',
        'foto_sebelum_pks',
        'foto_sesudah_pks'
    ];
}
