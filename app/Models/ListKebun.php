<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListKebun extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_kebun'
    ];
}
