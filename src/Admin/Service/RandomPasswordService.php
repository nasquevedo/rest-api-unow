<?php

namespace App\Admin\Service;

use App\Admin\Service\RandomPasswordServiceInterface;

class RandomPasswordService implements RandomPasswordServiceInterface
{
    public function generate()
    {
        return uniqid();
    }
}