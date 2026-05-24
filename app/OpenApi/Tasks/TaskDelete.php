<?php

namespace App\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Delete(
    path: "/api/tasks/{id}",
    summary: "Delete a task",
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
        new OA\Response(
            response: 200,
            description: "Task deleted successfully"
        ),
        new OA\Response(
            response: 404,
            description: "Task not found"
        )
    ]
)]
class TaskDelete {}