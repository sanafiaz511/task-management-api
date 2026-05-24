<?php

namespace App\OpenApi\Tasks;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/tasks",
    summary: "Get all tasks",
    tags: ["Tasks"],
    responses: [
        new OA\Response(response: 200, description: "Success")
    ]
)]
class TaskIndex {}