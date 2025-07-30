<?php

namespace App\Admin\Application\UpdateEmployee;

interface UpdateEmployeeApplicationInterface
{
    public function update($id, $data): array;
}