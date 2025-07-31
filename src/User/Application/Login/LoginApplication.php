<?php

namespace App\User\Application\Login;

use App\User\Domain\Models\UserModel\UserModel;
use App\User\Application\Login\LoginApplicationInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LoginApplication implements LoginApplicationInterface
{
    public function __construct(
        private TokenStorageInterface $tokenStorage
    )
    {}

    public function login() : array
    {
        $token = $this->tokenStorage->getToken();
        
        if ($token) {
            $user = $token->getUser();

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

        return [];
    }
}