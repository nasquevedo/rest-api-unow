<?php

namespace App\Admin\Application\DeleteEmployee;

use App\Admin\Application\DeleteEmployee\DeleteEmployeeApplicationInterface;
use App\User\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class DeleteEmployeeApplication implements DeleteEmployeeApplicationInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager
    )
    {}

    public function delete($id): bool
    {
        $user = $this->userRepository->find($id);

        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
            
            return true;
        }

        return false;
    }
}