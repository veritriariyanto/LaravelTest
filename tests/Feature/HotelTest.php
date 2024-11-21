<?php

namespace Tests\Feature\HotelTest;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Destination;

class HotelTest extends TestCase
{
    // use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a user to authenticate
        $this->user = User::factory()->create(); // Ensure User model has a factory
    }

    public function test_mengakses_halaman_Hotel(): void
    {
        $this->actingAs($this->user);
        $response = $this->get('/hotels');
        $response->assertStatus(200);
    }

    public function test_menambahkan_data_baru_hotel(): void
{
    $this->actingAs($this->user);

    // Buat destinasi baru menggunakan factory
    $destination = Destination::factory()->create();

    $response = $this->post(route('hotels.store'), [
        'nama_hotel' => 'Hotel Kuta',
        'alamat' => 'Jalan Raya Kuta, Bali',
        'harga_per_malam' => 500000,
        'destination_id' => $destination->id, // Gunakan ID dari destinasi yang baru dibuat
    ]);

    $response->assertRedirect(route('hotels.index'));

    // Verifikasi data tersimpan di database
    $this->assertDatabaseHas('hotels', [
        'nama_hotel' => 'Hotel Kuta',
        'alamat' => 'Jalan Raya Kuta, Bali',
        'harga_per_malam' => 500000,
        'destination_id' => $destination->id,
    ]);
}


    public function test_data_hotel_yang_ditampilkan_sesuai_data_tersimpan(): void
{
    $this->actingAs($this->user);

    // Buat data destinasi dan hotel menggunakan factory
    $destination = Destination::factory()->create();

    Hotel::create([
        'nama_hotel' => 'Hotel Kuta',
        'alamat' => 'Jalan Raya Kuta, Bali',
        'harga_per_malam' => 500000,
        'destination_id' => $destination->id,
    ]);



    $response = $this->get(route('hotels.index'));

    // Verifikasi halaman menampilkan data yang diharapkan
    $response->assertStatus(200);
    $response->assertSeeText('Hotel Kuta');
    $response->assertSeeText('Jalan Raya Kuta, Bali');
    $response->assertSeeText('Rp 500.000');
}


public function test_update_data_hotel(): void
{
    $this->actingAs($this->user);

    // Buat data destinasi dan hotel menggunakan factory
    $destination = Destination::factory()->create();
    $hotel = Hotel::factory()->create([
        'nama_hotel' => 'Hotel Kuta',
        'alamat' => 'Jalan Raya Kuta, Bali',
        'harga_per_malam' => 500000,
        'destination_id' => $destination->id,
    ]);

    $updateData = [
        'nama_hotel' => 'Hotel Jimbaran',
        'alamat' => 'Jalan Jimbaran, Bali',
        'harga_per_malam' => 600000,
        'destination_id' => $destination->id,
    ];

    $response = $this->put(route('hotels.update', $hotel->id), $updateData);

    $response->assertRedirect(route('hotels.index'));

    // Verifikasi data telah diperbarui di database
    $this->assertDatabaseHas('hotels', [
        'id' => $hotel->id,
        'nama_hotel' => 'Hotel Jimbaran',
        'alamat' => 'Jalan Jimbaran, Bali',
        'harga_per_malam' => 600000,
        'destination_id' => $destination->id,
    ]);
}


    public function test_hapus_data_hotel(): void
    {
        $this->actingAs($this->user);
        $hotel = Hotel::where('id', '!=', 25)->first();

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
