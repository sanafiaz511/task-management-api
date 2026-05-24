<?php

namespace App\OpenApi\Projects;

use OpenApi\Attributes as OA;

class ProjectShow
{
    #[OA\Get(
        path: "/api/projects/{id}",
        summary: "Get project by ID",
        tags: ["Projects"],
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