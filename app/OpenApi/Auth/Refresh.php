<?php

namespace App\OpenApi\Auth;

use OpenApi\Attributes as OA;

class Refresh
{
    #[OA\Post(
        path: "/api/refresh",
        summary: "Refresh JWT token",
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "New token generated"
            )
        ],
        security: [
            ["bearerAuth" => []]
        ]
    )]
    public function __invoke() {}
}