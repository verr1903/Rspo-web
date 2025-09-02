<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListKebun;

class ListKebunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ListKebun::create(
            [
                'nama_kebun' => 'Kebun Tandun',
            ],
        );
        ListKebun::create(
            [
                'nama_kebun' => 'Kebun Sei Berlian',
            ],
        );
        ListKebun::create(
            [
                'nama_kebun' => 'Kebun Sei Lindai',
            ],
        );
        ListKebun::create(
            [
                'nama_kebun' => 'Kebun Sei Rokan',
            ],
        );
        ListKebun::create(
            [
                'nama_kebun' => 'Kebun Sei Intan',
            ],
        );
        ListKebun::create(
            [
                'nama_kebun' => 'Kebun Sei Tapung',
            ],
        );

    }
}

