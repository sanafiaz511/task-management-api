<?php

namespace App\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/tasks",
    summary: "Create task",
    tags: ["Tasks"],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "title", type: "string"),
                new OA\Property(property: "project_id", type: "integer")
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: "Created")
    ]
)]
class TaskStore {}