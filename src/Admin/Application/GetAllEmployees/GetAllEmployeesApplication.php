<?php

namespace App\Admin\Application\GetAllEmployees;

use App\Admin\Application\GetAllEmployees\GetAllEmployeesApplicationInterface;
use App\User\Domain\Models\UserModel\UserModel;
use App\User\Infrastructure\Repository\UserRepositoryInterface;

class GetAllEmployeesApplication implements GetAllEmployeesApplicationInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {}

    public function getAll() :array
    {
        $users = $this->userRepository->findByRole('ROLE_USER');

        $data = [];
        foreach ($users as $user) {
            $userModel = new UserModel(
                $user->getId(),
                $user->getName(),
                $user->getLastName(),
                $user->getRoles(),
                $user->getEmail(),
                $user->getPosition(),
                $user->getBirthdate()
            );
            $data[] = $userModel->toArray();
        }

        return $data;
    }
}