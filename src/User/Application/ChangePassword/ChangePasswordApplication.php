<?php

namespace App\User\Application\ChangePassword;

use App\User\Infrastructure\Entity\User;
use App\User\Application\ChangePassword\ChangePasswordApplicationInterface;
use App\User\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangePasswordApplication implements ChangePasswordApplicationInterface
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userHasher,
        private EntityManagerInterface $entityManager
    )
    {}

    public function change(string $password, string $newPassword): bool
    {
        $token = $this->tokenStorage->getToken();
        
        if (!$token) {
            return false;
        }

        $user = $token->getUser();

        if (!$this->userHasher->isPasswordValid($user, $password)) {
            return false;
        }

        $newPasswordHashed = $this->userHasher->hashPassword(
            $user,
            $newPassword
        );

        $user->setPassword($newPasswordHashed);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }
}