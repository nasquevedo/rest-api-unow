<?php

namespace App\Admin\Application\GetEmployee;

use App\Admin\Application\GetEmployee\GetEmployeeApplicationInterface;
use App\User\Domain\Models\UserModel\UserModel;
use App\User\Infrastructure\Repository\UserRepository;

class GetEmployeeApplication implements GetEmployeeApplicationInterface
{
    public function __construct(
        private UserRepository $userRepository
    )
    {}

    public function get($id): array
    {       
        $user = $this->userRepository->find($id);

        $userModel = new UserModel(
            $user->getId(),
            $user->getName(),
            $user->getLastName(),
            $user->getRoles(),
            $user->getEmail(),
            $user->getPosition(),
            $user->getBirthdate()
        );

        return $userModel->toArray();
    }
}