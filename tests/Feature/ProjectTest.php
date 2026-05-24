<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_create_project()
    {
        $user = \App\Models\User::factory()->create();

        $token = auth('api')->login($user);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/projects', [
                'title' => 'Test Project',
                'description' => 'Demo project'
            ]);

        $response->assertStatus(201);
    }

    public function test_user_can_list_projects()
    {
        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        \App\Models\Project::factory()->count(3)->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200);
    }

    public function test_user_can_delete_project()
    {
        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        $project = \App\Models\Project::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(200);
    }
}
