<?php

namespace Database\Factories;

use App\Models\Hotels;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelsFactory extends Factory
{
    protected $model = Hotels::class;

    public function definition()
    {
        return [
            'nama_hotel' => $this->faker->company,
            'alamat' => $this->faker->address,
            'harga_per_malam' => $this->faker->numberBetween(200000, 1000000),
            'destination_id' => \App\Models\Destinations::factory(), // Pastikan destinasi terkait ada
        ];
    }
}
