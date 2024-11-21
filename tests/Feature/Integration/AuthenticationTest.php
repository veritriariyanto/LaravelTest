<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_and_redirect_to_register_if_user_not_found(): void
    {
        // Login dengan akun yang tidak ada
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_register_and_logout_flow(): void
    {
        // 1. Simulasi proses registrasi
        $response = $this->post('/register', [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
        ]);

        // 2. Verifikasi pengguna terautentikasi setelah registrasi
        $this->assertAuthenticated();
        $response->assertRedirect(route('pakets.index', absolute: false));

        // 3. Simulasi logout
        $response = $this->post('/logout');

        // 4. Pastikan pengguna menjadi guest
        $this->assertGuest();

        // 5. Verifikasi diarahkan ke halaman login setelah logout
        $response->assertRedirect('/');
    }

    // public function test_login_success_and_redirect_to_pakets_page(): void
    // {
    //     // Buat pengguna
    //     $user = User::factory()->create([
    //         'password' => bcrypt('password'),
    //     ]);

    //     // Login
    //     $response = $this->post('/login', [
    //         'email' => $user->email,
    //         'password' => 'password',
    //     ]);

    //     // Harus terautentikasi
    //     $this->assertAuthenticated();

    //     // Diredirect ke halaman pakets
    //     $response->assertRedirect(route('pakets.index', absolute: false));
    // }

    // public function test_logout_and_redirect_to_home_page(): void
    // {
    //     // Buat pengguna
    //     $user = User::factory()->create();

    //     // Login dan logout
    //     $this->actingAs($user)->post('/logout');

    //     // Harus menjadi guest
    //     $this->assertGuest();

    //     // Diredirect ke halaman home
    //     $this->post('/logout')->assertRedirect('/login');
    // }
}
