<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListPks;

class ListPksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       ListPks::create(
            [
                'nama_pks' => 'PKS Tandun',
            ],
        );
       ListPks::create(
            [
                'nama_pks' => 'PKS Sei Rokan',
            ],
        );
    }
}
