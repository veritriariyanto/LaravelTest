<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\Destination;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;


class DestinationTest extends TestCase
{
    use RefreshDatabase; // Tambahkan trait ini
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Storage::deleteDirectory('public/destinations'); // Membersihkan direktori destinasi
    }

    public function test_crud_operations_work_together(): void
    {

        $this->actingAs($this->user);

        // 1. Tambahkan destinasi baru
        Storage::fake('public');
        $file = UploadedFile::fake()->image('image.jpg');

        $response = $this->post(route('destinations.store'), [
            'image' => $file,
            'nama_destinasi' => 'Pantai Indah',
            'deskripsi' => 'Pantai dengan pasir putih',
            'lokasi' => 'Bali, Indonesia',
            'htm' => 100000,
        ]);

        $response->assertRedirect(route('destinations.index'));
        $this->assertDatabaseHas('destinations', ['nama_destinasi' => 'Pantai Indah']);

        // 2. Ambil data destinasi yang baru saja ditambahkan
        $destination = Destination::where('nama_destinasi', 'Pantai Indah')->first();
        $this->assertNotNull($destination);

        // 3. Perbarui data destinasi
        $updateResponse = $this->put(route('destinations.update', $destination->id), [
            'nama_destinasi' => 'Pantai Indah Baru',
            'deskripsi' => 'Pantai dengan pasir putih dan sunset indah',
            'lokasi' => 'Bali Utara, Indonesia',
            'htm' => 150000,
        ]);

        $updateResponse->assertRedirect(route('destinations.index'));
        $this->assertDatabaseHas('destinations', ['nama_destinasi' => 'Pantai Indah Baru']);

        // 4. Hapus data destinasi
        $deleteResponse = $this->delete(route('destinations.destroy', $destination->id));
        $deleteResponse->assertRedirect(route('destinations.index'));
        $this->assertDatabaseMissing('destinations', ['id' => $destination->id]);
    }

    public function test_create_destination_with_invalid_data(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('destinations.store'), [
            'image' => '',
            'nama_destinasi' => '',
            'deskripsi' => '',
            'lokasi' => '',
            'htm' => '',
        ]);

        // Pastikan ada error validation
        $response->assertSessionHasErrors(['image', 'nama_destinasi', 'deskripsi', 'lokasi', 'htm']);
    }

    public function test_crud_operations_without_authentication(): void
    {
        // Tes akses halaman index tanpa login
        $response = $this->get(route('destinations.index'));
        $response->assertRedirect(route('login'));

        // Tes tambah data tanpa login
        $response = $this->post(route('destinations.store'), [
            'nama_destinasi' => 'Pantai Rahasia',
            'deskripsi' => 'Pantai tersembunyi',
            'lokasi' => 'Indonesia',
            'htm' => 50000,
        ]);
        $response->assertRedirect(route('login'));
    }

    public function test_file_upload_and_storage_integration(): void
    {
        $this->actingAs($this->user);
        // Storage::fake('public');

        $file = UploadedFile::fake()->image('destination.jpg');

        $response = $this->post(route('destinations.store'), [
            'image' => $file,
            'nama_destinasi' => 'Pantai Upload',
            'deskripsi' => 'Pantai dengan fitur upload',
            'lokasi' => 'Lombok, Indonesia',
            'htm' => 150000,
        ]);

        $response->assertRedirect(route('destinations.index'));

        // Verify destination was created
        $destination = Destination::where('nama_destinasi', 'Pantai Upload')->first();
        $this->assertNotNull($destination);

        // Use the image name from the saved destination
        $expectedPath = 'destinations/' . $destination->image;

        $this->assertTrue(
            Storage::disk('public')->exists($expectedPath),
            "File not found at path: $expectedPath"
        );
    }

}
