<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Test User',
            'email' => 'test123@example.com',
            'password' => 'password123',
            'role' => 'member'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'user'
            ]);
    }

    public function test_user_can_login()
    {
        \App\Models\User::factory()->create([
            'email' => 'test123@example.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token'
            ]);
    }
}
