<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AutoAuthMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_auto_login_into_filament(): void
    {
        $this->assertDatabaseEmpty('users');
        $this->assertGuest();
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('poke/login');
        $redirect = $this->get('poke/login');
        $this->assertDatabaseCount('users', 1);
        $this->assertAuthenticated();
    }

    /**
     * @test
     */
    public function can_auto_login_after_logging_out(): void
    {
        $response = $this->get('/');
        $redirect = $this->get('poke/login');
        $this->assertDatabaseCount('users', 1);
        $this->assertAuthenticated();
        Auth::logout();
        $this->assertDatabaseCount('users', 1);
        $this->assertGuest();
        $response = $this->get('/');
        $redirect = $this->get('poke/login');
        $this->assertDatabaseCount('users', 1);
        $this->assertAuthenticated();
    }
}
