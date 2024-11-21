<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transport;

class TransportSeeder extends Seeder
{
    public function run()
    {
        Transport::factory()->count(50)->create();
    }
}
