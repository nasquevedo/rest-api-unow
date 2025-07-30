<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class Controller extends AbstractController
{
    #[Route('/', name: 'app_health_check', methods: ['GET'])]
    public function index()
    {
        return new JsonResponse([
            'success' => true,
            "message" => "healthcheck"
        ]);
    }
}