<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;
    // GET comments for a task
    public function index(Request $request)
    {
        $task = Task::whereHas('project', function ($q) {
            $q->where('user_id', auth('api')->id());
        })->findOrFail($request->task_id);

        return response()->json(
            $task->comments()->with('user')->latest()->get()
        );
    }

    // CREATE comment
    public function store(StoreCommentRequest $request)
    {
        // 🔐 ensure task belongs to logged-in user's project
        $task = Task::whereHas('project', function ($q) {
            $q->where('user_id', auth('api')->id());
        })->findOrFail($request->task_id);

        $comment = $task->comments()->create([
            'user_id' => auth('api')->id(),
            'body' => $request->body
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'data' => $comment
        ], 201);
    }

    // DELETE comment
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted'
        ]);
    }
}