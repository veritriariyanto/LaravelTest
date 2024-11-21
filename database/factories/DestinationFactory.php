<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    public function definition()
    {
        return [
            'nama_destinasi' => $this->faker->city(),
            'deskripsi' => $this->faker->paragraph(),
            'lokasi' => $this->faker->address(),
            'htm' => $this->faker->randomFloat(2, 10000, 500000),
            'image' => $this->faker->imageUrl(640, 480, 'destinations', true),
        ];
    }
}
