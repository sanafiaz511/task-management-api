<?php

namespace App\OpenApi\Projects;

use OpenApi\Attributes as OA;

class ProjectDelete
{
    #[OA\Delete(
        path: "/api/projects/{id}",
        summary: "Delete project",
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
            new OA\Response(response: 200, description: "Deleted")
        ]
    )]
    public function __invoke() {}
}