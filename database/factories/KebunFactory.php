<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kebun;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kebun>
 */
class KebunFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kebun::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'tanggal_pengiriman' => $this->faker->date(),
            'nama_kebun' => $this->faker->randomElement(['Kebun Tandun', 'Kebun Sei Berlian', 'Kebun Sei Lindai', 'Kebun Sei Rokan', 'Kebun Sei Intan', 'Kebun Sei Tapung']),
            'afdeling' => $this->faker->randomElement(['I', 'II', 'III', 'IV', 'V', 'VI','VII','VIII','IX','X']),
            'nomor_blanko_pb25' => $this->faker->numerify('PB25-###'),
            'nopol_mobil' => $this->faker->bothify('BK #### ??'),
            'nama_supir' => $this->faker->name(),
            'foto_keseluruhan_kebun' => 'kebun/tester.png',
            'foto_sebelum_kebun'     => 'kebun/tester.png',
            'foto_sesudah_kebun'     => 'kebun/tester.png',
        ];
    }
}
