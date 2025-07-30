<?php

namespace App\Admin\Application\GetEmployee;

interface GetEmployeeApplicationInterface
{
    public function get($id): array;
}