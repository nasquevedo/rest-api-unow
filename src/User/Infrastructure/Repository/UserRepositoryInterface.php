<?php

namespace App\User\Infrastructure\Repository;

use App\User\Infrastructure\Entity\User;

interface UserRepositoryInterface {
    public function findByRole($role): array;
    public function findOneByEmail($email): ?User;
}