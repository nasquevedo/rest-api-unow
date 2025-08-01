<?php

namespace App\shared\Service\Mailer;

interface MailerServiceInterface
{
    public function send(string $endpoint, string $email, string $subject, string $message);
}