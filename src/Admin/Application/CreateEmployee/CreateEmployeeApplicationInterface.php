<?php

namespace App\Admin\Application\CreateEmployee;

interface CreateEmployeeApplicationInterface
{
    public function create(array $data) :array;
}