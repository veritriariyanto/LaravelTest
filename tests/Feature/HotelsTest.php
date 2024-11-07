<?php

namespace Tests\Feature\HotelTest;

use App\Models\Hotels;
use App\Models\User;
use Tests\TestCase;

class HotelsTest extends TestCase
{
    // use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a user to authenticate
        $this->user = User::factory()->create(); // Ensure User model has a factory
    }

    public function test_mengakses_halaman_hotels(): void
    {
        $this->actingAs($this->user);
        $response = $this->get('/hotels');
        $response->assertStatus(200);
    }

    public function test_menambahkan_data_baru_hotel(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('hotels.store'), [
            'nama_hotel' => 'Hotel Kuta',
            'alamat' => 'Jalan Raya Kuta, Bali',
            'harga_per_malam' => 500000,
            'destination_id' => 25, // Assuming a valid destination ID exists
        ]);

        $response->assertRedirect(route('hotels.index'));

        // Verify that the data was saved in the database
        $this->assertDatabaseHas('hotels', [
            'nama_hotel' => 'Hotel Kuta',
            'alamat' => 'Jalan Raya Kuta, Bali',
            'harga_per_malam' => 500000,
        ]);
    }

    public function test_data_hotel_yang_ditampilkan_sesuai_data_tersimpan(): void
    {
        $this->actingAs($this->user);

        // Create a hotel to ensure data is available
        $hotel = Hotels::where('id', '!=', 25)->first();

        $response = $this->get(route('hotels.index'));

        // Assert that the page contains the expected data
        $response->assertStatus(200);
        $response->assertSeeText('Hotel Kuta');
        $response->assertSeeText('Jalan Raya Kuta, Bali');
        $response->assertSeeText('Rp 500.000');
    }

    public function test_update_data_hotel(): void
    {
        $this->actingAs($this->user);

        $hotel = Hotels::where('id', '!=', 25)->first();

        $updateData = [
            'nama_hotel' => 'Hotel Jimbaran',
            'alamat' => 'Jalan Jimbaran, Bali',
            'harga_per_malam' => 600000,
            'destination_id' => $hotel->destination_id,
        ];

        $response = $this->put(route('hotels.update', $hotel->id), $updateData);

        $response->assertRedirect(route('hotels.index'));

        // Verify that the data was updated in the database
        $this->assertDatabaseHas('hotels', [
            'id' => $hotel->id,
            'nama_hotel' => 'Hotel Jimbaran',
            'alamat' => 'Jalan Jimbaran, Bali',
            'harga_per_malam' => 600000,
        ]);
    }

    public function test_hapus_data_hotel(): void
    {
        $this->actingAs($this->user);
        $hotel = Hotels::where('id', '!=', 25)->first();

        $deleteResponse = $this->delete(route('hotels.destroy', $hotel->id));
        $deleteResponse->assertRedirect(route('hotels.index'));

        // Ensure the hotel no longer exists in the database
        $this->assertDatabaseMissing('hotels', [
            'id' => $hotel->id,
        ]);
    }

    public function test_menambahkan_data_baru_hotel_dengan_isian_kosong(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('hotels.store'), [
            'nama_hotel' => '',
            'alamat' => '',
            'harga_per_malam' => '',
            'destination_id' => '',
        ]);
        $response->assertSessionHasErrors(['nama_hotel', 'alamat', 'harga_per_malam', 'destination_id']);
    }

    public function test_update_data_hotel_yang_tidak_ada(): void
    {
        $this->actingAs($this->user);
        $nonExistentId = 9999;

        $response = $this->put(route('hotels.update', $nonExistentId), [
            'nama_hotel' => 'Hotel Fiktif',
            'alamat' => 'Alamat Fiktif',
            'harga_per_malam' => 500000,
            'destination_id' => 1,
        ]);

        $response->assertNotFound(); // Expected a 404 response
    }

    public function test_operasi_crud_tanpa_hak_akses(): void
    {
        $response = $this->get('/hotels');
        $response->assertRedirect(route('login'));
    }
}
