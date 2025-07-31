<?php

namespace App\shared\Service\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

interface ResponseServiceInterface
{
     public function response(bool $success, string $message = "", array $data = []): JsonResponse;
}