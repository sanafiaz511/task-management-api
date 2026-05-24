<?php

namespace App\OpenApi\Projects;

use OpenApi\Attributes as OA;

class ProjectStore
{
    #[OA\Post(
        path: "/api/projects",
        summary: "Create project",
        tags: ["Projects"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "New Project"),
                    new OA\Property(property: "description", type: "string", example: "Project details")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Created")
        ]
    )]
    public function __invoke() {}
}