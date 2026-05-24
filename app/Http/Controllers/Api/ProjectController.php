<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;

class ProjectController extends Controller
{
    // GET /projects
    public function index()
    {
        return response()->json(
            auth('api')->user()->projects()->latest()->get()
        );
    }

    // POST /projects
    public function store(StoreProjectRequest $request)
    {
        $project = auth('api')->user()->projects()->create($request->validated());

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }

    // GET /projects/{id}
    public function show($id)
    {
        $project = auth('api')->user()->projects()->findOrFail($id);

        return response()->json($project);
    }

    // PUT /projects/{id}
    public function update(StoreProjectRequest $request, $id)
    {
        $project = auth('api')->user()->projects()->findOrFail($id);

        $project->update($request->validated());

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

        return response()->json([
            'message' => 'Project deleted successfully'
        ]);
    }
}