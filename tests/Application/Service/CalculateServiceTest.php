<?php

namespace App\Tests\Application\Service;

use App\Calculation\Application\Service\CalculateService;
use PHPUnit\Framework\TestCase;

class CalculateServiceTest extends TestCase
{
    public function testGetValueByPercentage()
    {
        $calculateService = new CalculateService();

        $percentageValue = $calculateService->getValueByPercentage(398.00, 10);

        $this->assertEquals(39.80, $percentageValue);
    }

    public function testGetTotalFees()
    {
        $fees = [
            ["name" => "Basic", "value" => 39.80],
            ["name" => "Special", "value" => 7.96],
            ["name" => "Association", "value" => 5.0],
            ["name" => "Storage", "value" => 100.0]
        ];

        $calculateService = new CalculateService();
        $totalFees = $calculateService->getTotalFees($fees);

        $this->assertEquals(152.76, $totalFees);
    }

    public function testGetTotal()
    {
        $vehicleBasePrice = 398.00;
        $totalFees = 152.76;

        $calculateService = new CalculateService();
        $total = $calculateService->getTotal($vehicleBasePrice, $totalFees);

        $this->assertEquals(550.76, $total);
    }
}