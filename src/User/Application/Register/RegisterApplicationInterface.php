<?php

namespace App\User\Application\Register;

interface RegisterApplicationInterface
{
    public function register($data): bool;
}