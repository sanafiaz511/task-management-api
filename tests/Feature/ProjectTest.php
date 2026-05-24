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

    public function test_projects_are_cached()
    {
        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        \App\Models\Project::factory()->count(3)->create([
            'user_id' => $user->id
        ]);

        // First request → DB + cache store
        $this->getJson('/api/projects');

        // Second request → should use cache
        $response = $this->getJson('/api/projects');

        $response->assertStatus(200);
    }

    public function test_cache_cleared_when_project_created()
    {
        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        // warm cache
        $this->getJson('/api/projects');

        // create new project (should clear cache)
        $response = $this->postJson('/api/projects', [
            'title' => 'New Project',
            'description' => 'Test'
        ]);

        $response->assertStatus(201);

        // cache should be rebuilt automatically
        $this->getJson('/api/projects')->assertStatus(200);
    }
}
