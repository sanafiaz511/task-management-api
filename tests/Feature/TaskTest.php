<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendTaskCreatedEmailJob;
use Illuminate\Support\Facades\Event;
use App\Events\TaskCreated;

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

    public function test_tasks_are_cached_per_project()
    {
        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        $project = \App\Models\Project::factory()->create([
            'user_id' => $user->id
        ]);

        \App\Models\Task::factory()->count(3)->create([
            'project_id' => $project->id
        ]);

        $this->getJson("/api/tasks?project_id={$project->id}");

        $response = $this->getJson("/api/tasks?project_id={$project->id}");

        $response->assertStatus(200);
    }

    public function test_email_job_is_dispatched()
    {
        Queue::fake();

        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        $project = \App\Models\Project::factory()->create([
            'user_id' => $user->id
        ]);

        $this->postJson('/api/tasks', [
            'project_id' => $project->id,
            'title' => 'Test Task',
            'status' => 'todo'
        ]);

        Queue::assertPushed(SendTaskCreatedEmailJob::class);
    }

    public function test_task_created_event_is_fired()
    {
        Event::fake();

        $user = \App\Models\User::factory()->create();
        auth('api')->login($user);

        $project = \App\Models\Project::factory()->create([
            'user_id' => $user->id
        ]);

        $this->postJson('/api/tasks', [
            'project_id' => $project->id,
            'title' => 'Test Task',
            'status' => 'todo'
        ]);

        Event::assertDispatched(TaskCreated::class);
    }

    public function test_user_cannot_access_other_users_tasks()
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
