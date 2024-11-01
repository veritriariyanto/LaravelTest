<?php

namespace Database\Factories;

use App\Models\Destinations;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationsFactory extends Factory
{
    protected $model = Destinations::class;

    public function definition()
    {
        return [
            'nama_destinasi' => $this->faker->city,
            'deskripsi' => $this->faker->text,
            'lokasi' => $this->faker->address,
            'htm' => $this->faker->numberBetween(10000, 1000000),
        ];
    }
}
