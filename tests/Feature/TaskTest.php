<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_create_task()
    {
        Event::fake();
        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        $project = \App\Models\Project::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->postJson('/api/tasks', [
            'project_id' => $project->id,
            'title' => 'Task 1',
            'description' => 'Demo task',
            'status' => 'todo',
            'due_date' => now()->addDays(7)->toDateString(),
            'priority' => 'medium'
        ]);

        $response->assertStatus(201);
    }

    public function test_user_can_list_tasks()
    {
        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        $project = \App\Models\Project::factory()->create([
            'user_id' => $user->id
        ]);

        \App\Models\Task::factory()->count(3)->create([
            'project_id' => $project->id
        ]);

        $response = $this->getJson("/api/tasks?project_id={$project->id}");

        $response->assertStatus(200);
    }
}
