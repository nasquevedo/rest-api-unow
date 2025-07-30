<?php

namespace App\User\Service\ValidateEmail;

use App\User\Infrastructure\Entity\User;
use App\User\Infrastructure\Repository\UserRepositoryInterface;
use App\User\Service\ValidateEmail\ValidateEmailServiceInterface;

class ValidateEmailService implements ValidateEmailServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {}

    public function validate($email)
    {
        $user = $this->userRepository->findOneByEmail($email);

        return $user ?? false;
    }
}