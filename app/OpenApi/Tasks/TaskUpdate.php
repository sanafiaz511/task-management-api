<?php

namespace App\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Put(
    path: "/api/tasks/{id}",
    summary: "Update a task",
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
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "title", type: "string", example: "Updated title"),
                new OA\Property(property: "description", type: "string", example: "Updated description")
            ]
        )
    ),
    responses: [
        new OA\Response(
            response: 200,
            description: "Task updated successfully"
        ),
        new OA\Response(
            response: 404,
            description: "Task not found"
        )
    ]
)]
class TaskUpdate {}