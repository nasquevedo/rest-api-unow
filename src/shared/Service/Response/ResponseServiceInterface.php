<?php

namespace App\shared\Service\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

interface ResponseServiceInterface
{
     public function response($success, $message = "", $data = []): JsonResponse;
}