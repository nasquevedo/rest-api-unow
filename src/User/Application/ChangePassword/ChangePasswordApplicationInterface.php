<?php

namespace App\User\Application\ChangePassword;

interface ChangePasswordApplicationInterface
{
    public function change(string $password, string $newPassword): bool;
}