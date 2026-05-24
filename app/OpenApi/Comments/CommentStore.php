<?php

namespace App\OpenApi\Comments;

use OpenApi\Attributes as OA;

class CommentStore
{
    #[OA\Post(
        path: "/api/comments",
        summary: "Add comment to a task",
        tags: ["Comments"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["task_id", "body"],
                properties: [
                    new OA\Property(property: "task_id", type: "integer", example: 1),
                    new OA\Property(property: "body", type: "string", example: "This is a comment")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Comment created"
            )
        ]
    )]
    public function __invoke() {}
}