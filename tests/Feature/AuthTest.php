<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
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
        $email = 'test@example.com';
        $password = 'password123';

        \App\Models\User::factory()->create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token'
            ]);
    }

    public function test_user_can_logout()
    {
        $user = \App\Models\User::factory()->create();

        $token = auth('api')->login($user);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/auth/logout');

        $response->assertStatus(200);
    }

    public function test_user_can_refresh_token()
    {
        $user = \App\Models\User::factory()->create();

        $token = auth('api')->login($user);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/auth/refresh');

        $response->assertStatus(200)
            ->assertJsonStructure(['access_token']);
    }
}
