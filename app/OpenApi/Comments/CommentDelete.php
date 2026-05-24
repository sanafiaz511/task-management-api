<?php

namespace App\OpenApi\Comments;

use OpenApi\Attributes as OA;

class CommentDelete
{
    #[OA\Delete(
        path: "/api/comments/{id}",
        summary: "Delete comment",
        tags: ["Comments"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer"),
                example: 1
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Comment deleted"
            ),
            new OA\Response(
                response: 403,
                description: "Unauthorized"
            )
        ]
    )]
    public function __invoke() {}
}