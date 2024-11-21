<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transport;
use App\Models\Destination;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransportTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

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

        // 2. Tambahkan transport baru
        $response = $this->post(route('transports.store'), [
            'nama_transport' => 'busHijau',
            'tipe_transport' => 'bis',
            'biaya' => 500000,
            'destination_id' => $destination->id,
        ]);

        $response->assertRedirect(route('transports.index'));
        $this->assertDatabaseHas('transports', [
            'nama_transport' => 'busHijau',
            'tipe_transport' => 'bis',
            'biaya' => 500000,
            'destination_id' => $destination->id,
        ]);

        // 3. Ambil data transport yang baru ditambahkan
        $transport = Transport::where('nama_transport', 'busHijau')->first();
        $this->assertNotNull($transport);

        // 4. Update data transport
        $updateData = [
            'nama_transport' => 'busKuning',
            'tipe_transport' => 'bis',
            'biaya' => 600000,
            'destination_id' => $destination->id,
        ];

        $updateResponse = $this->put(route('transports.update', $transport->id), $updateData);
        $updateResponse->assertRedirect(route('transports.index'));

        $this->assertDatabaseHas('transports', [
            'id' => $transport->id,
            'nama_transport' => 'busKuning',
            'tipe_transport' => 'bis',
            'biaya' => 600000,
            'destination_id' => $destination->id,
        ]);

        // 5. Hapus data transport
        $deleteResponse = $this->delete(route('transports.destroy', $transport->id));
        $deleteResponse->assertRedirect(route('transports.index'));

        $this->assertDatabaseMissing('transports', [
            'id' => $transport->id,
        ]);
    }

    public function test_create_transport_with_invalid_data(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('transports.store'), [
            'nama_transport' => '',
            'tipe_transport' => '',
            'biaya' => '',
            'destination_id' => '',
        ]);

        $response->assertSessionHasErrors(['nama_transport', 'tipe_transport', 'biaya', 'destination_id']);
    }

    public function test_crud_operations_without_authentication(): void
    {
        // Tes akses halaman index tanpa login
        $response = $this->get(route('transports.index'));
        $response->assertRedirect(route('login'));

        // Tes tambah data tanpa login
        $response = $this->post(route('transports.store'), [
            'nama_transport' => 'busRahasia',
            'tipe_transport' => 'bis',
            'biaya' => 200000,
            'destination_id' => 1,
        ]);
        $response->assertRedirect(route('login'));
    }

    public function test_transport_and_destination_relation(): void
    {
        $this->actingAs($this->user);

        // Buat destinasi
        $destination = Destination::factory()->create();

        // Buat transport yang terkait dengan destinasi
        $transport = Transport::factory()->create([
            'destination_id' => $destination->id,
            'nama_transport' => 'busBali',
            'tipe_transport' => 'bis',
            'biaya' => 450000,
        ]);

        // Debugging
        dump($transport->toArray());
        dump($transport->destination);

        // Pastikan transport terkait dengan destinasi yang benar
        $this->assertNotNull($transport->destination, 'Destination is null for transport ID: ' . $transport->id);
        $this->assertEquals($transport->destination->id, $destination->id);
        $this->assertDatabaseHas('transports', [
            'id' => $transport->id,
            'destination_id' => $destination->id,
        ]);
    }

    public function test_update_non_existent_transport(): void
    {
        $this->actingAs($this->user);

        // ID transport yang tidak ada
        $nonExistentId = 99999;

        // Membuat destinasi yang valid
        $destination = Destination::factory()->create();

        $response = $this->put(route('transports.update', $nonExistentId), [
            'nama_transport' => 'busMerah',
            'tipe_transport' => 'bis',
            'biaya' => 100000,
            'destination_id' => $destination->id,
        ]);

        // Memastikan respons yang benar adalah 404 Not Found
        $response->assertNotFound();
    }

    public function test_access_transport_page_without_authentication(): void
    {
        $response = $this->get(route('transports.index'));
        $response->assertRedirect(route('login'));
    }
}
