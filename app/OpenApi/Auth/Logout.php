<?php

namespace App\OpenApi\Auth;

use OpenApi\Attributes as OA;

class Logout
{
    #[OA\Post(
        path: "/api/logout",
        summary: "Logout user",
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Logged out successfully"
            )
        ],
        security: [
            ["bearerAuth" => []]
        ]
    )]
    public function __invoke() {}
}