<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Destination;

class TransportFactory extends Factory
{
    public function definition()
    {
        return [
            'nama_transport' => $this->faker->word(),
            'tipe_transport' => $this->faker->randomElement(['bis', 'travel', 'pesawat', 'kapal']),
            'biaya' => $this->faker->numberBetween(50000, 500000),
            'destination_id' => Destination::inRandomOrder()->first()->id,
        ];
    }
}
