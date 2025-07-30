<?php

namespace App\User\Application\Register;

use App\User\Infrastructure\Entity\User;
use App\User\Application\Register\RegisterApplicationInterface;
use App\User\Service\ValidateEmail\ValidateEmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTimeImmutable;

class RegisterApplication implements RegisterApplicationInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidateEmailService $validateEmailService,
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {}

    public function register($data): bool
    {

        $email = $this->validateEmailService->validate($data['email']);

        if (!$email) {

            $user = new User();

            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRoles(['ROLE_USER']);
            $user->setName($data["name"]);
            $user->setLastName($data['lastName']);
            $user->setPosition($data['position']);
            $user->setBirthdate(new DateTimeImmutable($data['birthdate']));

            $hashPassword = $this->userPasswordHasher->hashPassword(
                $user,
                $data["password"]
            );

            $user->setPassword($hashPassword);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return true;
        }

        return false;
    }
}