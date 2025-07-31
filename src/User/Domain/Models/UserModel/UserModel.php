<?php

namespace App\User\Domain\Models\UserModel;

use App\User\Domain\Models\UserModel\UserModelInterface;
use DateTimeImmutable;
use DateTime;

class UserModel implements UserModelInterface
{
    public function __construct(
        private int $id,
        private string $name,
        private string $lastName,
        private array $roles,
        private string $email,
        private string $position,
        private DateTimeImmutable|DateTime $birthdate
    ) 
    {}

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "lastName" => $this->lastName,
            "roles" => $this->roles,
            "email" => $this->email,
            "position" => $this->position,
            "birthdate" => $this->birthdate
        ];
    }
}