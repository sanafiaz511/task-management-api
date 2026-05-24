<?php

namespace App\OpenApi\Auth;

use OpenApi\Attributes as OA;

class Register
{
    #[OA\Post(
        path: "/api/register",
        summary: "Register a new user",
        tags: ["Auth"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "email", "password"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "John Doe"),
                    new OA\Property(property: "email", type: "string", example: "john@example.com"),
                    new OA\Property(property: "password", type: "string", example: "123456"),
                    new OA\Property(property: "role", type: "string", example: "member")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User registered successfully with token"
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )
        ]
    )]
    public function __invoke() {}
}