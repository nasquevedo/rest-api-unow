<?php

namespace App\shared\Service\CustomeMessage;

interface CustomMessageServiceInterface
{
    public function customWelcomeMessage(string $name, string $passoword): string;

    public function customRegisterMessage(string $name): string;
}