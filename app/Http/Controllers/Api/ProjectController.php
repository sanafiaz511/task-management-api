<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\CacheService;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    // GET /projects
    public function index()
    {
        $userId = auth('api')->id();

        return CacheService::remember("projects:user:$userId", 60, function () {
            return auth('api')->user()->projects()->latest()->get();
        });
    }

    // POST /projects
    public function store(StoreProjectRequest $request)
    {
        $project = auth('api')->user()->projects()->create($request->validated());

        CacheService::forget("projects:user:" . auth('api')->id());

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }

    // GET /projects/{id}
    public function show($id)
    {
        $project = CacheService::remember("project:$id", 60, function () use ($id) {
            return auth('api')->user()->projects()->findOrFail($id);
        });
        $this->authorize('view', $project);
        return response()->json($project);
    }

    // PUT /projects/{id}
    public function update(StoreProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($request->validated());

        CacheService::forget("project:" . $project->id);
        CacheService::forget("projects:user:" . auth('api')->id());

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => $project
        ]);
    }

    // DELETE /projects/{id}
    public function destroy($id)
    {
        $project = auth('api')->user()->projects()->findOrFail($id);

        $project->delete();

        CacheService::forget("project:$id");
        CacheService::forget("projects:user:" . auth('api')->id());

        return response()->json([
            'message' => 'Project deleted successfully'
        ]);
    }
}