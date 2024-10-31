<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Destinations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DestinationTest extends TestCase
{
    /**
     * Test menampilkan daftar destinasi
     *
     * @return void
     */
    public function test_can_view_destinations()
    {
        // Menggunakan factory untuk membuat data destinasi
        $destination = Destinations::factory()->create();

        // Mengirim permintaan GET ke rute `destinations.index`
        $response = $this->get(route('destinations.index'));

        // Memastikan halaman menampilkan destinasi yang telah dibuat
        $response->assertStatus(200);
        $response->assertSee($destination->nama_destinasi);
    }

    /**
     * Test menyimpan destinasi dengan data valid
     *
     * @return void
     */
    public function test_store_destination_with_valid_data()
    {
        Storage::fake('public');

        // Data destinasi yang akan disimpan
        $data = [
            'image' => UploadedFile::fake()->image('destinasi.jpg'),
            'nama_destinasi' => 'Pantai Indah',
            'lokasi' => 'Jalan Pantai No.1',
            'htm' => 150000,
        ];

        // Mengirim permintaan POST untuk menyimpan destinasi
        $response = $this->post(route('destinations.store'), $data);

        // Memastikan data berhasil disimpan di database
        $this->assertDatabaseHas('destinations', [
            'nama_destinasi' => 'Pantai Indah',
        ]);

        // Memastikan file gambar ada di storage
        $this->assertTrue(Storage::disk('public')->exists('destinations/destinasi.jpg'));

        // Memastikan redirect ke halaman destinasi
        $response->assertRedirect(route('destinations.index'));
    }

    /**
     * Test validasi saat menyimpan destinasi
     *
     * @return void
     */
    public function test_store_destination_validation()
    {
        // Mengirim permintaan POST tanpa data
        $response = $this->post(route('destinations.store'), []);

        // Memastikan session memiliki kesalahan validasi
        $response->assertSessionHasErrors(['image', 'nama_destinasi', 'lokasi', 'htm']);
    }

    // Test untuk mengupdate dan menghapus destinasi akan tetap ada di sini.
    // Namun, kita akan fokus pada fungsi menyimpan data saja saat ini.
}
