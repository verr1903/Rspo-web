<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListAfdeling;

class ListAfdelingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ListAfdeling::create(
            [
                'afdeling' => 'I',
            ],
        );
        ListAfdeling::create(
            [
                'afdeling' => 'II',
            ],
        );
        ListAfdeling::create(
            [
                'afdeling' => 'III',
            ],
        );
        ListAfdeling::create(
            [
                'afdeling' => 'IV',
            ],
        );
        ListAfdeling::create(
            [
                'afdeling' => 'V',
            ],
        );
        ListAfdeling::create(
            [
                'afdeling' => 'VI',
            ],
        );
        ListAfdeling::create(
            [
                'afdeling' => 'VII',
            ],
        );
        ListAfdeling::create(
            [
                'afdeling' => 'VIII',
            ],
        );
        ListAfdeling::create(
            [
                'afdeling' => 'IX',
            ],
        );
        ListAfdeling::create(
            [
                'afdeling' => 'X',
            ],
        );
    }
}
