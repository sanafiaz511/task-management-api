<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    // GET tasks under a project
    public function index(Request $request)
    {
        $project = auth('api')->user()
            ->projects()
            ->findOrFail($request->project_id);

        return response()->json(
            $project->tasks()->latest()->get()
        );
    }

    // CREATE task
    public function store(StoreTaskRequest $request)
    {
        // 🔐 Ensure project belongs to user
        $project = auth('api')->user()
            ->projects()
            ->findOrFail($request->project_id);

        $task = $project->tasks()->create($request->validated());

        return response()->json([
            'message' => 'Task created successfully',
            'data' => $task
        ], 201);
    }

    // SHOW task
    public function show($id)
    {
        $task = Task::whereHas('project', function ($q) {
            $q->where('user_id', auth('api')->id());
        })->findOrFail($id);

        return response()->json($task);
    }

    // UPDATE task
    public function update(StoreTaskRequest $request, $id)
    {
        $task = Task::whereHas('project', function ($q) {
            $q->where('user_id', auth('api')->id());
        })->findOrFail($id);

        $task->update($request->validated());

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task
        ]);
    }

    // DELETE task
    public function destroy($id)
    {
        $task = Task::whereHas('project', function ($q) {
            $q->where('user_id', auth('api')->id());
        })->findOrFail($id);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}