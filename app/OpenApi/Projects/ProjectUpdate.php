<?php

namespace App\OpenApi\Projects;

use OpenApi\Attributes as OA;

class ProjectUpdate
{
    #[OA\Put(
        path: "/api/projects/{id}",
        summary: "Update project",
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
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string"),
                    new OA\Property(property: "description", type: "string")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Updated"),
            new OA\Response(response: 404, description: "Not found")
        ]
    )]
    public function __invoke() {}
}