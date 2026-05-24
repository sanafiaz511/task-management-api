<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Task Management API",
    version: "1.0.0",
    description: "Task Management System API"
)]
#[OA\Server(
    url: "http://localhost",
    description: "Local server"
)]
class ApiDoc {}