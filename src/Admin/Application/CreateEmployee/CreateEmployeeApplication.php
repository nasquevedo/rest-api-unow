<?php

namespace App\Admin\Application\CreateEmployee;

use App\User\Infrastructure\Entity\User;
use App\Admin\Application\CreateEmployee\CreateEmployeeApplicationInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Admin\Service\RandomPasswordServiceInterface;
use App\User\Domain\Models\UserModel\UserModel;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTimeImmutable;
use DateTime;

class CreateEmployeeApplication implements CreateEmployeeApplicationInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RandomPasswordServiceInterface $randomPasswordService,
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {}

    public function create(array $data): array
    {
        $randomPassword = $this->randomPasswordService->generate();
        $user = new User();

        $user->setEmail($data['email']);
        $user->setRoles(['ROLE_USER']);
        $user->setName($data['name']);
        $user->setLastName($data['lastName']);
        $user->setPosition($data['position']);
        $user->setBirthdate(new DateTimeImmutable($data['birthdate']));

        $hashPassword = $this->userPasswordHasher->hashPassword(
            $user,
            $randomPassword
        );

        $user->setPassword($hashPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

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