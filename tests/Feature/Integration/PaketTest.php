<?php

namespace Tests\Feature;

use App\Models\Paket;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Transport;
use App\Models\Destination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaketTest extends TestCase
{
    use RefreshDatabase; // Reset database antara pengujian

    protected function setUp(): void
    {
        parent::setUp();
        // Buat pengguna untuk otentikasi
        $this->user = User::factory()->create();
    }

    public function test_crud_operations_work_together(): void
    {
        $this->actingAs($this->user);

        // 1. Tambahkan destinasi baru
        $destination = Destination::factory()->create();

        // 2. Tambahkan hotel baru
        $hotel = Hotel::factory()->create();

        // 3. Tambahkan transport baru
        $transport = Transport::factory()->create();

        // 4. Tambahkan paket baru
        $response = $this->post(route('pakets.store'), [
            'nama_paket' => 'Paket Liburan Bali',
            'deskripsi' => 'Paket liburan ke Bali selama 3 hari.',
            'harga_total' => 1500000,
            'destination_id' => $destination->id,
            'hotel_id' => $hotel->id,
            'transport_id' => $transport->id,
        ]);

        // Pastikan mengalihkan ke daftar paket
        $response->assertRedirect(route('pakets.index'));

        // Verifikasi bahwa Paket baru ada di database
        $this->assertDatabaseHas('pakets', [
            'nama_paket' => 'Paket Liburan Bali',
            'harga_total' => 1500000,
            'destination_id' => $destination->id,
            'hotel_id' => $hotel->id,
            'transport_id' => $transport->id,
        ]);

        // 5. Ambil data paket yang baru ditambahkan
        $paket = Paket::where('nama_paket', 'Paket Liburan Bali')->first();
        $this->assertNotNull($paket);

        // 6. Update data paket
        $updateData = [
            'nama_paket' => 'Paket Liburan Bali Terupdate',
            'deskripsi' => 'Paket liburan ke Bali selama 4 hari.',
            'harga_total' => 2000000,
            'destination_id' => $destination->id,
            'hotel_id' => $hotel->id,
            'transport_id' => $transport->id,
        ];

        $updateResponse = $this->put(route('pakets.update', $paket->id), $updateData);
        $updateResponse->assertRedirect(route('pakets.index'));

        // Verifikasi data diperbarui di database
        $this->assertDatabaseHas('pakets', [
            'id' => $paket->id,
            'nama_paket' => 'Paket Liburan Bali Terupdate',
            'harga_total' => 2000000,
        ]);

        // 7. Hapus data paket
        $deleteResponse = $this->delete(route('pakets.destroy', $paket->id));
        $deleteResponse->assertRedirect(route('pakets.index'));

        // Pastikan Paket dihapus dari database
        $this->assertDatabaseMissing('pakets', [
            'id' => $paket->id,
        ]);
    }

    public function test_create_paket_with_invalid_data(): void
    {
        $this->actingAs($this->user);

        // Kirim permintaan untuk menambahkan paket dengan data yang tidak valid
        $response = $this->post(route('pakets.store'), [
            'nama_paket' => '',
            'deskripsi' => '',
            'harga_total' => '',
            'destination_id' => '', // Relasi yang kosong
            'hotel_id' => '',
            'transport_id' => '',
        ]);

        // Pastikan ada kesalahan pada session
        $response->assertSessionHasErrors(['nama_paket', 'deskripsi', 'harga_total', 'destination_id', 'hotel_id', 'transport_id']);
    }

    public function test_crud_operations_without_authentication(): void
    {
        // Tes akses halaman index tanpa login
        $response = $this->get(route('pakets.index'));
        $response->assertRedirect(route('login'));

        // Tes tambah data tanpa login
        $response = $this-> post(route('pakets.store'), [
            'nama_paket' => 'Paket Rahasia',
            'deskripsi' => 'Deskripsi fiktif',
            'harga_total' => 1000000,
            'destination_id' => 1,
            'hotel_id' => 1,
            'transport_id' => 1,
        ]);
        $response->assertRedirect(route('login'));
    }

    public function test_paket_and_related_models_relation(): void
    {
        $this->actingAs($this->user);

        // Buat destinasi, hotel, dan transport
        $destination = Destination::factory()->create();
        $hotel = Hotel::factory()->create(['destination_id' => $destination->id]);
        $transport = Transport::factory()->create();

        // Buat paket
        $paket = Paket::factory()->create([
            'destination_id' => $destination->id,
            'hotel_id' => $hotel->id,
            'transport_id' => $transport->id,
            'nama_paket' => 'Paket Liburan Bali',
            'harga_total' => 1500000,
        ]);

        // Pastikan paket terkait dengan model yang benar
        $this->assertEquals($paket->destination->id, $destination->id);
        $this->assertEquals($paket->hotel->id, $hotel->id);
        $this->assertEquals($paket->transport->id, $transport->id);
    }
}
