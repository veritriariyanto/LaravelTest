<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transport;


class TransportTest extends TestCase
{

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_mengakses_halaman_transport(): void
    {
        $this->actingAs($this->user);
        $response = $this->get('/transports');
        $response->assertStatus(200);
    }

    public function test_menambahkan_data_baru_transport(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('transports.store'), [
            'nama_transport' => 'busHijau',
            'tipe_transport' => 'bis',
            'biaya' => 500000,
            'destination_id' => 25,
        ]);

        $response->assertRedirect(route('transports.index'));

        $this->assertDatabaseHas('transports', [
            'nama_transport' => 'busHijau',
            'tipe_transport' => 'bis',
            'biaya' => 500000,
        ]);
    }
    public function test_data_Transport_yang_ditampilkan_sesuai_data_tersimpan(): void
    {
        $this->actingAs($this->user);

        // Create a transport to ensure data is available
        $Transport = Transport::where('id', '!=', 25)->first();

        $response = $this->get(route('transports.index'));

        // Assert that the page contains the expected data
        $response->assertStatus(200);
        $response->assertSeeText('busHijau');
        $response->assertSeeText('bis');
        $response->assertSeeText('Rp 500.000');
    }
    public function test_update_data_Transport(): void
    {
        $this->actingAs($this->user);

        $Transport = Transport::where('id', '!=', 25)->first();

        $updateData = [
            'nama_transport' => 'busKuning',
            'tipe_transport' => 'bis',
            'biaya' => 500000,
            'destination_id' => $Transport->destination_id,
        ];


        $response = $this->put(route('transports.update', $Transport->id), $updateData);

        $response->assertRedirect(route('transports.index'));

        $this->assertDatabaseHas('transports', [
            'id' => $Transport->id,
            'nama_transport' => 'busKuning',
            'tipe_transport' => 'bis',
            'biaya' => 500000,
        ]);
    }
    public function test_hapus_data_Transport(): void
    {
        $this->actingAs($this->user);
        $Transport = Transport::where('id', '!=', 25)->first();

        $deleteResponse = $this->delete(route('transports.destroy', $Transport->id));
        $deleteResponse->assertRedirect(route('transports.index'));

        // Ensure the transport no longer exists in the database
        $this->assertDatabaseMissing('transports', [
            'id' => $Transport->id,
        ]);
    }
    public function test_menambahkan_data_baru_Transport_dengan_isian_kosong(): void
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
    public function test_update_non_existent_transport()
    {
        $this->actingAs($this->user);

        $nonExistentId = 99999;

        $response = $this->put(route('transports.update', $nonExistentId), [
            'nama_transport' => 'busmerah',
            'tipe_transport' => 'bis',
            'biaya' => 100,
            'destination_id' => 25,
        ]);

        $response->assertNotFound();
    }
    public function test_operasi_crud_tanpa_hak_akses(): void
    {
        $response = $this->get('/transports');
        $response->assertRedirect(route('login'));
    }
}
