<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that public responses include all required security headers.
     */
    public function test_public_pages_include_security_headers(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        $this->assertNotEmpty($response->headers->get('Content-Security-Policy'));
    }

    /**
     * Test that unauthenticated access to admin routes is redirected.
     */
    public function test_unauthenticated_admin_access_redirects_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/admin/login');
    }

    /**
     * Test that DatabaseSeeder does not create the default admin user in production.
     */
    public function test_database_seeder_does_not_create_test_admin_in_production(): void
    {
        $this->app->detectEnvironment(fn () => 'production');

        $this->artisan('db:seed', [
            '--class' => DatabaseSeeder::class,
            '--force' => true,
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => 'teste@estudionorra.com',
        ]);
    }
}
