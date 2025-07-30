<?php

namespace App\User\Infrastructure\Controller;

use App\User\Application\Register\RegisterApplicationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\shared\Service\Response\ResponseServiceInterface;

final class UserController extends AbstractController
{
    public function __construct(
        private RegisterApplicationInterface $registerApplication,
        private ResponseServiceInterface $responseService
    )
    {}

    #[Route('/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = $request->toArray();

        $registered = $this->registerApplication->register($data);

        return $this->responseService->response(
            $registered,
            $registered ? 'User Created' : 'User already Exists',
        );
    }
}
