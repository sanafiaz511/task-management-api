<?php

namespace App\OpenApi\Tasks;

use OpenApi\Attributes as OA;

class TaskShow
{
    #[OA\Get(
        path: "/api/tasks/{id}",
        summary: "Get task by ID",
        tags: ["Tasks"],
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
            new OA\Response(response: 200, description: "Success"),
            new OA\Response(response: 404, description: "Not found")
        ]
    )]
    public function __invoke() {}
}