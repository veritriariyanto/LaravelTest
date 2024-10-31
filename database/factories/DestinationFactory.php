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
            'image' => 'default_image.jpg', // Anda bisa mengganti ini dengan logika upload file jika perlu
            'nama_destinasi' => $this->faker->words(3, true), // Nama destinasi acak
            'deskripsi' => $this->faker->sentence(10), // Deskripsi acak
            'lokasi' => $this->faker->address, // Lokasi acak
            'htm' => $this->faker->randomNumber(5), // Harga acak
        ];
    }
}
