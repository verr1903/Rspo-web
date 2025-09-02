<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListAfdeling extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'afdeling'
    ];
}
