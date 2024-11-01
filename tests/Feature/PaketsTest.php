<?php

namespace Tests\Feature;

use App\Models\Pakets;
use App\Models\User;
use App\Models\Destinations;
use App\Models\Hotels;
use App\Models\Transports;
use Tests\TestCase;

class PaketsTest extends TestCase
{
    // use RefreshDatabase; // Uncomment if you want to reset the database for each test

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a user to authenticate
        $this->user = User::factory()->create(); // Ensure User model has a factory
    }

    public function test_mengakses_halaman_pakets(): void
    {
        $this->actingAs($this->user);
        $response = $this->get('/pakets');
        $response->assertStatus(200);
    }

    public function test_menambahkan_data_baru_paket(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('pakets.store'), [
            'nama_paket' => 'Paket Liburan Bali',
            'deskripsi' => 'Paket liburan ke Bali selama 3 hari.',
            'harga_total' => 1500000,
            'destination_id' => 25,
            'hotel_id' => 25,
            'transport_id' => 25,
        ]);

        $response->assertRedirect(route('pakets.index'));

        // Verify that the data was saved in the database
        $this->assertDatabaseHas('pakets', [
            'nama_paket' => 'Paket Liburan Bali',
            'harga_total' => 1500000,
        ]);
    }

    public function test_data_paket_yang_ditampilkan_sesuai_data_tersimpan(): void
    {
        $this->actingAs($this->user);

        $paket = Pakets::first();

        $response = $this->get(route('pakets.index'));

        // Assert that the page contains the expected data
        $response->assertStatus(200);
        $response->assertSeeText('Paket Liburan Bali');
        $response->assertSeeText('Paket liburan ke Bali selama 3 hari.');
        $response->assertSeeText('Rp 1.500.000');
    }

    public function test_update_data_paket(): void
    {
        $this->actingAs($this->user);

        $paket = Pakets::first();

        $updateData = [
            'nama_paket' => 'Paket Liburan Bali Terupdate',
            'deskripsi' => 'Paket liburan ke Bali selama 4 hari.',
            'harga_total' => 2000000,
            'destination_id' => 25,
            'hotel_id' => 25,
            'transport_id' => 25,
        ];

        $response = $this->put(route('pakets.update', $paket->id), $updateData);

        $response->assertRedirect(route('pakets.index'));

        // Verify that the data was updated in the database
        $this->assertDatabaseHas('pakets', [
            'id' => $paket->id,
            'nama_paket' => 'Paket Liburan Bali Terupdate',
            'harga_total' => 2000000,
        ]);
    }

    public function test_hapus_data_paket(): void
    {
        $this->actingAs($this->user);

        // Create a package for testing
        $paket = Pakets::first();

        $deleteResponse = $this->delete(route('pakets.destroy', $paket->id));
        $deleteResponse->assertRedirect(route('pakets.index'));

        // Ensure the package no longer exists in the database
        $this->assertDatabaseMissing('pakets', [
            'id' => $paket->id,
        ]);
    }

    public function test_menambahkan_data_baru_paket_dengan_isian_kosong(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('pakets.store'), [
            'nama_paket' => '',
            'deskripsi' => '',
            'harga_total' => '',
            'destination_id' => '',
            'hotel_id' => '',
            'transport_id' => '',
        ]);
        $response->assertSessionHasErrors(['nama_paket', 'deskripsi', 'harga_total', 'destination_id', 'hotel_id', 'transport_id']);
    }

    public function test_update_data_paket_yang_tidak_ada(): void
    {
        $this->actingAs($this->user);
        $nonExistentId = 9999;

        $response = $this->put(route('pakets.update', $nonExistentId), [
            'nama_paket' => 'Paket Fiktif',
            'deskripsi' => 'Deskripsi Fiktif',
            'harga_total' => 500000,
            'destination_id' => 25,
            'hotel_id' => 25,
            'transport_id' => 25,
        ]);

        $response->assertNotFound(); // Expected a 404 response
    }

    public function test_operasi_crud_tanpa_hak_akses(): void
    {
        $response = $this->get('/pakets');
        $response->assertRedirect(route('login'));
    }
}
