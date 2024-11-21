<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Transport;

class PaketFactory extends Factory
{
    public function definition()
    {
        return [
            'nama_paket' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph(),
            'harga_total' => $this->faker->randomFloat(2, 500000, 5000000),
            'destination_id' => Destination::inRandomOrder()->first()->id,
            'hotel_id' => Hotel::inRandomOrder()->first()->id,
            'transport_id' => Transport::inRandomOrder()->first()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'ulasan' => $this->faker->numberBetween(0, 100),
            'total_pembelian' => $this->faker->numberBetween(0, 500),
        ];
    }
}
