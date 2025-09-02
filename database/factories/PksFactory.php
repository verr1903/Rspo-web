<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pks;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pks>
 */
class PksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pks::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal_pengiriman'    => $this->faker->date(),
            'nama_pks'              => $this->faker->randomElement(['PKS A', 'PKS B', 'PKS C']),
            'tujuan_pengiriman'     => $this->faker->city(),
            'nomor_blanko_pb33'     => $this->faker->numerify('PB33-###'),
            'nopol_mobil'           => $this->faker->bothify('BK #### ??'),
            'nama_supir'            => $this->faker->name(),
            'foto_keseluruhan_pks'  => 'https://via.placeholder.com/300x200.png?text=Foto+1',
            'foto_sebelum_pks'      => 'https://via.placeholder.com/300x200.png?text=Foto+2',
            'foto_sesudah_pks'      => 'https://via.placeholder.com/300x200.png?text=Foto+3',
        ];
    }
}
