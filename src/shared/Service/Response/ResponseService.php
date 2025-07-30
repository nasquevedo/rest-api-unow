<?php

namespace App\shared\Service\Response;

use App\shared\Service\Response\ResponseServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseService implements ResponseServiceInterface
{
    public function response($success, $message = "", $data = []): JsonResponse
    {
        return new JsonResponse([
            "success" => $success,
            "message" => $message,
            "data" => $data
        ]);
    }
}