<?php
use Tests\TestCase;
use App\Models\Hotel;
use App\Models\Destination;
use App\Models\User; // Pastikan model User diimport dengan benar
use Illuminate\Foundation\Testing\RefreshDatabase;

class HotelTest extends TestCase
{
    use RefreshDatabase; // Tambahkan trait ini

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_crud_operations_work_together(): void
    {
        $this->actingAs($this->user);

        // 1. Tambahkan destinasi baru
        $destination = Destination::factory()->create();

        // 2. Tambahkan hotel baru
        $response = $this->post(route('hotels.store'), [
            'nama_hotel' => 'Hotel Kuta',
            'alamat' => 'Jalan Raya Kuta, Bali',
            'harga_per_malam' => 500000,
            'destination_id' => $destination->id, // Relasi dengan destinasi
        ]);

        $response->assertRedirect(route('hotels.index'));
        $this->assertDatabaseHas('hotels', [
            'nama_hotel' => 'Hotel Kuta',
            'alamat' => 'Jalan Raya Kuta, Bali',
            'harga_per_malam' => 500000,
            'destination_id' => $destination->id,
        ]);

        // 3. Ambil data hotel yang baru ditambahkan
        $hotel = Hotel::where('nama_hotel', 'Hotel Kuta')->first();
        $this->assertNotNull($hotel);

        // 4. Update data hotel
        $updateData = [
            'nama_hotel' => 'Hotel Jimbaran',
            'alamat' => 'Jalan Jimbaran, Bali',
            'harga_per_malam' => 600000,
            'destination_id' => $destination->id,
        ];

        $updateResponse = $this->put(route('hotels.update', $hotel->id), $updateData);
        $updateResponse->assertRedirect(route('hotels.index'));

        $this->assertDatabaseHas('hotels', [
            'id' => $hotel->id,
            'nama_hotel' => 'Hotel Jimbaran',
            'alamat' => 'Jalan Jimbaran, Bali',
            'harga_per_malam' => 600000,
            'destination_id' => $destination->id,
        ]);

        // 5. Hapus data hotel
        $deleteResponse = $this->delete(route('hotels.destroy', $hotel->id));
        $deleteResponse->assertRedirect(route('hotels.index'));

        $this->assertDatabaseMissing('hotels', [
            'id' => $hotel->id,
        ]);
    }

    public function test_create_hotel_with_invalid_data(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('hotels.store'), [
            'nama_hotel' => '',
            'alamat' => '',
            'harga_per_malam' => '',
            'destination_id' => '', // Relasi yang kosong
        ]);

        $response->assertSessionHasErrors(['nama_hotel', 'alamat', 'harga_per_malam', 'destination_id']);
    }

    public function test_crud_operations_without_authentication(): void
    {
        // Tes akses halaman index tanpa login
        $response = $this->get(route('hotels.index'));
        $response->assertRedirect(route('login'));

        // Tes tambah data tanpa login
        $response = $this->post(route('hotels.store'), [
            'nama_hotel' => 'Hotel Rahasia',
            'alamat' => 'Alamat Fiktif',
            'harga_per_malam' => 200000,
            'destination_id' => 1,
        ]);
        $response->assertRedirect(route('login'));
    }

    public function test_hotel_and_destination_relation(): void
    {
        $this->actingAs($this->user);

        // Buat destinasi dan hotel
        $destination = Destination::factory()->create();
        $hotel = Hotel::factory()->create([
            'destination_id' => $destination->id,
            'nama_hotel' => 'Hotel Bali',
            'alamat' => 'Jalan Bali, Bali',
            'harga_per_malam' => 450000,
        ]);

        // Pastikan hotel terkait dengan destinasi yang benar
        $this->assertEquals($hotel->destination->id, $destination->id);
        $this->assertDatabaseHas('hotels', [
            'id' => $hotel->id,
            'destination_id' => $destination->id,
        ]);
    }
}

