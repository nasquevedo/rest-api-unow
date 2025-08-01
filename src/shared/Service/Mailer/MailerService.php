<?php

namespace App\shared\Service\Mailer;

use App\shared\Service\Mailer\MailerServiceInterface;
use GuzzleHttp\Client;

class MailerService implements MailerServiceInterface
{
    private $client;

    public function __construct() 
    {
        $this->client = new Client();
    }

    public function send(string $endpoint, string $email, string $subject, string $message)
    {
        try {
            $response = $this->client->post($endpoint, [
                "headers" => [
                    "Content-Type" => "application/json"
                ],
                "body" => json_encode([
                    "email" => $email,
                    "subject" => $subject,
                    "message" => $message
                ])
            ]);
            $statusCode = $response->getStatusCode();
            if ($statusCode === 200) {
                $data = json_decode($response->getBody(), true);
                return $data;
            }
        } catch(\Exception $e) {
            dd($e);
            return false;
        }
    }
}