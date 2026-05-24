<?php

namespace App\OpenApi\Projects;

use OpenApi\Attributes as OA;

class ProjectIndex
{
    #[OA\Get(
        path: "/api/projects",
        summary: "Get all projects",
        tags: ["Projects"],
        responses: [
            new OA\Response(response: 200, description: "Success")
        ]
    )]
    public function __invoke() {}
}