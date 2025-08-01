<?php

namespace App\User\Infrastructure\Controller;

use App\User\Application\Register\RegisterApplicationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\shared\Service\Response\ResponseServiceInterface;
use App\User\Application\ChangePassword\ChangePasswordApplicationInterface;
use App\User\Application\Login\LoginApplicationInterface;
use App\User\Application\UpdateUser\UpdateUserApplicationInterface;

final class UserController extends AbstractController
{
    public function __construct(
        private RegisterApplicationInterface $registerApplication,
        private ResponseServiceInterface $responseService,
        private LoginApplicationInterface $loginApplication,
        private UpdateUserApplicationInterface $updateUser,
        private ChangePasswordApplicationInterface $changePassword
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
    
    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        $user = $this->loginApplication->login();

        if (count($user) > 0) {
            return $this->responseService->response(
                true,
                "User was Found",
                $user
            );
        }

        return $this->responseService->response(
            false,
            "User not Fount",
            $user
        );
    }

    #[Route('/update/{id}', name: 'app_update_user', methods: ['PUT', 'PATCH'])]
    public function update($id, Request $request): JsonResponse
    {
        $data = $request->toArray();

        $newData = $this->updateUser->update($id, $data);

        if (count($newData) > 0) {
            return $this->responseService->response(
                true,
                "User Updated",
                $newData
            );
        }

        return $this->responseService->response(
            false,
            "User not Found"
        );
    }

    #[Route('/change-password', name: 'app_change_password_user', methods: ['PUT'])]
    public function changePassword(Request $request): JsonResponse
    {
        $data = $request->toArray();
        $changed = $this->changePassword->change($data['password'], $data['newPassword']);

        if ($changed) {
            return $this->responseService->response(
                true,
                "Password Changed"
            );
        }

        return $this->responseService->response(
            false,
            "Something went wrong"
        );
    }

    #[Route('/delete/{id}', name: 'app_delete_user', methods: ['DELETE'])]
    public function delete(): JsonResponse
    {
        return $this->responseService->response(
            true,
            "User Deleted"
        );
    }
}
