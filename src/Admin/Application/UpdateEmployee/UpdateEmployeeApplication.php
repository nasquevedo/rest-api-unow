<?php

namespace App\Admin\Application\UpdateEmployee;

use App\User\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;
use App\User\Domain\Models\UserModel\UserModel;

class UpdateEmployeeApplication implements UpdateEmployeeApplicationInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository
    )
    {}

    public function update($id, $data): array
    {
        $user = $this->userRepository->find($id);

        if ($user) {
            $user->setEmail($data['email']);
            $user->setName($data['name']);
            $user->setLastName($data['lastName']);
            $user->setPosition($data['position']);
            $user->setBirthdate(new DateTimeImmutable($data['birthdate']));

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

        return [];
    }
}