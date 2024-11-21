<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Destination;

class HotelFactory extends Factory
{
    public function definition()
    {
        return [
            'nama_hotel' => $this->faker->company(),
            'alamat' => $this->faker->address(),
            'harga_per_malam' => $this->faker->randomFloat(2, 200000, 1500000),
            'destination_id' => Destination::inRandomOrder()->first()->id,
        ];
    }
}
