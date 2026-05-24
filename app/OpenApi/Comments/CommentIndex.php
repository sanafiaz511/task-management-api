<?php

namespace App\OpenApi\Comments;

use OpenApi\Attributes as OA;

class CommentIndex
{
    #[OA\Get(
        path: "/api/comments",
        summary: "Get comments for a task",
        tags: ["Comments"],
        parameters: [
            new OA\Parameter(
                name: "task_id",
                in: "query",
                required: true,
                schema: new OA\Schema(type: "integer"),
                example: 1
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of comments"
            )
        ]
    )]
    public function __invoke() {}
}