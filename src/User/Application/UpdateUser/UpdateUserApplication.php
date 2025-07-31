<?php

namespace App\User\Application\UpdateUser;

use App\User\Domain\Models\UserModel\UserModel;
use App\User\Application\UpdateUser\UpdateUserApplicationInterface;
use App\User\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;

class UpdateUserApplication implements UpdateUserApplicationInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager
    )
    {}

    public function update($id, $data): array
    {
        $user = $this->userRepository->find($id);

        if ($user) {
            $user->setName($data['name']);
            $user->setLastName($data['lastName']);
            $user->setPosition($data['position']);
            $user->setBirthdate(new DateTimeImmutable($data['birthdate']));

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $newData = new UserModel(
                $user->getId(),
                $user->getName(),
                $user->getLastName(),
                $user->getRoles(),
                $user->getEmail(),
                $user->getPosition(),
                $user->getBirthdate()
            );

            return $newData->toArray();
        }

        return [];
    }
}