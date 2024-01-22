<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AutoAuthMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @test
     */
    public function can_auto_login_into_filament() : void
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
}
