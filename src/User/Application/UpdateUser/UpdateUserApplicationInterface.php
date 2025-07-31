<?php

namespace App\User\Application\UpdateUser;

interface UpdateUserApplicationInterface
{
    public function update($id, $data): array;
}