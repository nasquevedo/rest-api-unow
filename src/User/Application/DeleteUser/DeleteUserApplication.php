<?php

namespace App\User\Application\DeleteUser;

use App\User\Application\DeleteUser\DeleteUserApplictionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DeleteUserApplication implements DeleteUserApplictionInterface
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private EntityManagerInterface $entityManager
    )
    {}

    public function delete() :bool
    {
        $token = $this->tokenStorage->getToken();

        if (!$token) {
            return false;
        }

        $user = $token->getUser();
        
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return true;
    }
}