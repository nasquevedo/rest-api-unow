<?php

namespace App\Admin\Application\DeleteEmployee;

interface DeleteEmployeeApplicationInterface
{
    public function delete($id): bool;
}