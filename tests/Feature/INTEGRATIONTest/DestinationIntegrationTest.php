<?php

namespace Tests\Feature;

use App\Models\Destinations;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestinationIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_full_crud_operations(): void
    {
        // Authenticate as a user
        $this->actingAs($this->user);

        // 1. Create a new destination
        Storage::fake('public');
        $file = UploadedFile::fake()->image('destination.jpg');
        $createResponse = $this->post(route('destinations.store'), [
            'image' => $file,
            'nama_destinasi' => 'Pantai Kuta',
            'deskripsi' => 'Pantai dengan pemandangan indah',
            'lokasi' => 'Bali, Indonesia',
            'htm' => 100000,
        ]);
        $createResponse->assertRedirect(route('destinations.index'));
        $this->assertDatabaseHas('destinations', [
            'nama_destinasi' => 'Pantai Kuta',
            'lokasi' => 'Bali, Indonesia',
            'htm' => 100000,
        ]);

        // 2. Read the destination
        $readResponse = $this->get(route('destinations.index'));
        $readResponse->assertStatus(200);
        $readResponse->assertSeeText('Pantai Kuta');
        $readResponse->assertSeeText('Bali, Indonesia');
        $readResponse->assertSeeText('Rp 100.000');

        // 3. Update the destination
        $destination = Destinations::first();
        $newFile = UploadedFile::fake()->image('new_image.jpg');
        $updateResponse = $this->put(route('destinations.update', $destination->id), [
            'image' => $newFile,
            'nama_destinasi' => 'Pantai Jimbaran',
            'deskripsi' => 'Pantai terkenal dengan restoran seafood',
            'lokasi' => 'Jimbaran, Bali',
            'htm' => 150000,
        ]);
        $updateResponse->assertRedirect(route('destinations.index'));
        $this->assertDatabaseHas('destinations', [
            'id' => $destination->id,
            'nama_destinasi' => 'Pantai Jimbaran',
            'lokasi' => 'Jimbaran, Bali',
            'htm' => 150000,
        ]);

        // 4. Delete the destination
        $deleteResponse = $this->delete(route('destinations.destroy', $destination->id));
        $deleteResponse->assertRedirect(route('destinations.index'));
        $this->assertDatabaseMissing('destinations', [
            'id' => $destination->id,
        ]);
    }

    public function test_validation_errors_on_create(): void
    {
        $this->actingAs($this->user);

        $response = $this->post(route('destinations.store'), [
            'image' => '',
            'nama_destinasi' => '',
            'deskripsi' => '',
            'lokasi' => '',
            'htm' => '',
        ]);

        $response->assertSessionHasErrors(['image', 'nama_destinasi', 'deskripsi', 'lokasi', 'htm']);
    }

    public function test_404_on_updating_nonexistent_destination(): void
    {
        $this->actingAs($this->user);

        $response = $this->put(route('destinations.update', 9999), [
            'nama_destinasi' => 'Pantai Fiktif',
            'deskripsi' => 'Deskripsi Fiktif',
            'lokasi' => 'Lokasi Fiktif',
            'htm' => 50000,
        ]);

        $response->assertNotFound();
    }

    public function test_redirect_for_unauthenticated_user(): void
    {
        $response = $this->get(route('destinations.index'));
        $response->assertRedirect(route('login'));
    }
}
