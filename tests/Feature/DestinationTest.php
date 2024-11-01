<?php

namespace Tests\Feature\DestinationTest;

use App\Models\Destinations;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        // Simulate storage
        Storage::fake('public');

        // Create a fake image file
        $file = UploadedFile::fake()->image('ikan.jpg');

        // Post a request to create a new destination
        $this->post(route('destinations.store'), [
            'image' => $file,
            'nama_destinasi' => 'Pantai Sanur',
            'deskripsi' => 'Pantai dengan pemandangan matahari terbit',
            'lokasi' => 'Sanur, Bali',
            'htm' => 20000
        ])->assertRedirect(route('destinations.index'));

        // Follow the redirection to the destinations page and check the content
        $response = $this->get(route('destinations.index'));

        // Assert that the page contains the expected data
        $response->assertStatus(200);
        $response->assertSeeText('Pantai Sanur');
        // $response->assertSeeText('Pantai dengan pemandangan matahari terbit');
        $response->assertSeeText('Sanur, Bali');
        $response->assertSeeText('Rp 20.000');
    }


    public function test_Update_data()
    {
        $this->actingAs($this->user);
        // Ambil destinasi yang baru saja dibuat untuk diupdate
        $destination = Destinations::first();

        // Membuat file gambar palsu untuk update
        $newFile = UploadedFile::fake()->image('new_image.jpg');

        // Data update
        $updateData = [
            'image' => $newFile,
            'nama_destinasi' => 'Pantai Jimbaran',
            'deskripsi' => 'Pantai terkenal dengan restoran seafood dan sunset',
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
        $destination = Destinations::first();
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
    public function test_hapus_data_yang_digunakan_oleh_fitur_lain(): void
    {
        $this->actingAs($this->user);

        $destination = Destinations::factory()->create([
            'nama_destinasi' => 'Pantai Sanur',
        ]);
    }

    public function test_operasi_crud_tanpa_hak_akses(): void
    {

        $response = $this->get('/destinations');

        $response->assertRedirect(route('login'));
    }
}
