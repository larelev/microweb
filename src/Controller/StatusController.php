<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class StatusController
{
    #[Route(path: '/healthcheck', name: 'healthcheck')]
    public function healthCheck(): JsonResponse
    {
        return new JsonResponse([
            'app' => true
        ]);
    }
}
