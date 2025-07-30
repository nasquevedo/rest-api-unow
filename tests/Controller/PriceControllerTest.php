<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PriceControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', 'http://172.18.0.3/api/v1/price?price=398.00&type=1');

        self::assertResponseIsSuccessful();
    }

    public function testPriceControllerNoQueryFields()
    {
        $client = static::createClient();
        $client->request('GET', 'http://172.18.0.3/api/v1/price');

        self::assertResponseStatusCodeSame(400);
    }

    public function testPriceControllerTypeEmpty()
    {
        $client = static::createClient();
        $client->request('GET', 'http://172.18.0.3/api/v1/price?price=398.00&type=');

        self::assertResponseStatusCodeSame(400);
    }

    public function testPriceControllerPriceEmpty()
    {
        $client = static::createClient();
        $client->request('GET', 'http://172.18.0.3/api/v1/price?price=398.00&type=');

        self::assertResponseStatusCodeSame(400);
    }
}
