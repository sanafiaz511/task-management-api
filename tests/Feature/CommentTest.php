<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_create_comment()
    {
        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        $project = \App\Models\Project::factory()->create([
            'user_id' => $user->id
        ]);

        $task = \App\Models\Task::factory()->create([
            'project_id' => $project->id
        ]);

        $response = $this->postJson('/api/comments', [
            'task_id' => $task->id,
            'body' => 'Nice task'
        ]);

        $response->assertStatus(201);
    }

    public function test_user_cannot_access_other_user_project()
    {
        $user1 = \App\Models\User::factory()->create();
        $user2 = \App\Models\User::factory()->create();

        auth('api')->login($user1);

        $project = \App\Models\Project::factory()->create([
            'user_id' => $user2->id
        ]);

        $response = $this->getJson("/api/projects/{$project->id}");

        $response->assertStatus(404);
    }
}
