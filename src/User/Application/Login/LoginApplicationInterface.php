<?php

namespace App\User\Application\Login;

interface LoginApplicationInterface
{
    public function login(): array;
}