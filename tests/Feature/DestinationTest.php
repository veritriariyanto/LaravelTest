<?php

namespace Tests\Feature\DestinationTest;

use App\Models\Destination;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class DestinationTest extends TestCase
{
    // use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a user to authenticate
        $this->user = User::factory()->create(); // Make sure User model has a factory
    }
    public function test_mengakses_halaman_destinasi(): void
    {
        $this->actingAs($this->user);
        $response = $this->get('/destinations');
        $response->assertStatus(200);
    }

    public function test_menambahkan_data_baru(): void
    {
        $this->actingAs($this->user);
        // Simulasi penyimpanan
        Storage::fake('public');

        // Buat file gambar palsu
        $file = UploadedFile::fake()->image('ikan.jpg');

        $response = $this->post(route('destinations.store'), [
            'image' => $file,
            'nama_destinasi' => 'Pantai Kuta',
            'deskripsi' => 'pantai di bali',
            'lokasi' => 'Bali, indonesia',
            'htm' => 200000
        ]);

        $response->assertRedirect(route('destinations.index'));

        // Verifikasi data tersimpan dalam database
        $this->assertDatabaseHas('destinations', [
            'nama_destinasi' => 'Pantai Kuta',
            'lokasi' => 'Bali, indonesia',
            'htm' => 200000
        ]);
    }
    public function test_data_yang_ditampilkan_sesuai_dengan_data_tersimpan(): void
    {
        $this->actingAs($this->user);
        $response = $this->get(route('destinations.index'));
        $response->assertStatus(200);
        $response->assertSeeText('Pantai Kuta');
        // $response->assertSeeText('Pantai dengan pemandangan matahari terbit');
        $response->assertSeeText('Bali, indonesia');
        $response->assertSeeText('Rp 200.000');
    }


    public function test_Update_data()
    {
        $this->actingAs($this->user);
        // Ambil data destinasi
        $destination = Destination::where('id', '!=', 25)->first();
        // Membuat file gambar palsu untuk update
        $newFile = UploadedFile::fake()->image('new_image.jpg');

        // Data update
        $updateData = [
            'image' => $newFile,
            'nama_destinasi' => 'Pantai Jimbaran',
            'deskripsi' => 'Pantai terkenal dengan restoran seafood dan sunset update',
            'lokasi' => 'Jimbaran, Bali',
            'htm' => 75000,
        ];

        // Update destinasi
        $response = $this->put(route('destinations.update', $destination->id), $updateData);

        $response->assertRedirect(route('destinations.index'));

        // Verifikasi data diperbarui dalam database
        $this->assertDatabaseHas('destinations', [
            'id' => $destination->id,
            'nama_destinasi' => 'Pantai Jimbaran',
            'lokasi' => 'Jimbaran, Bali',
            'htm' => 75000,
        ]);
    }
    public function test_Hapus_data(): void
    {
        $this->actingAs($this->user);
        // Ambil destinasi yang baru saja dibuat untuk diupdate
        $destination = Destination::where('id', '!=', 25)->first();
        // Hapus destinasi
        $deleteResponse = $this->delete(route('destinations.destroy', $destination->id));
        // Verifikasi pengalihan setelah menghapus
        $deleteResponse->assertRedirect(route('destinations.index'));
        // Pastikan destinasi tidak ada lagi di database
        $this->assertDatabaseMissing('destinations', [
            'id' => $destination->id,
        ]);
    }
    public function test_menambahkan_data_baru_dengan_isianKosong(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('destinations.store'), [
            'image' => "",
            'nama_destinasi' => '',
            'deskripsi' => '',
            'lokasi' => '',
            'htm' => ''
        ]);
        $response->assertSessionHasErrors(['image', 'nama_destinasi', 'deskripsi', 'lokasi', 'htm']);
    }
    public function test_update_data_yang_tidak_ada(): void
    {
        $this->actingAs($this->user);
        $nonExistentId = 9999;

        $response = $this->put(route('destinations.update', $nonExistentId), [
            'nama_destinasi' => 'Pantai Fiktif',
            'deskripsi' => 'Deskripsi Fiktif',
            'lokasi' => 'Lokasi Fiktif',
            'htm' => 50000,
        ]);

        $response->assertNotFound(); // Expected a 404 response
    }

    public function test_operasi_crud_tanpa_hak_akses(): void
    {

        $response = $this->get('/destinations');

        $response->assertRedirect(route('login'));
    }
}
