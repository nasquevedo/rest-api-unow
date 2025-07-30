<?php

namespace App\Tests\Application;

use App\Calculation\Application\Service\CalculateService;
use App\Calculation\Application\Service\RuleServiceInterface;
use App\Calculation\Application\SpecialFeeApplication;
use PHPUnit\Framework\TestCase;

class SpecialFeeApplicationTest extends TestCase
{
    public function testSpecialFeeCommon()
    {
        $ruleService = $this->createMock(RuleServiceInterface::class);

        $ruleService
            ->expects($this->once())
            ->method('getRuleAttributes')
            ->willReturn([
                "percentage" => 2,
            ])
        ;

        $calculateService = $this->createMock(CalculateService::class);

        $calculateService
            ->expects($this->once())
            ->method('getValueByPercentage')
            ->willReturn(7.96)
        ;

        $specialFeeApp = new SpecialFeeApplication($ruleService, $calculateService);
        $specialFee = $specialFeeApp->getSpecialFee(398.00, 1);
        $equals = [
            "name" => 'Special',
            "value" => 7.96 
        ];

        $specialFeeArray = $specialFee->getArray();

        $this->assertIsArray($specialFeeArray);
        $this->assertEquals("Special", $specialFeeArray['name']);
        $this->assertEquals(7.96, $specialFeeArray['value']);
    }

    public function testSpecialFeeLuxury()
    {
        $ruleService = $this->createMock(RuleServiceInterface::class);

        $ruleService
            ->expects($this->once())
            ->method('getRuleAttributes')
            ->willReturn([
                "percentage" => 4,
            ])
        ;

        $calculateService = $this->createMock(CalculateService::class);

        $calculateService
            ->expects($this->once())
            ->method('getValueByPercentage')
            ->willReturn(72.00)
        ;

        $specialFeeApp = new SpecialFeeApplication($ruleService, $calculateService);
        $specialFee = $specialFeeApp->getSpecialFee(1800.00, 2);

        $specialFeeArray = $specialFee->getArray();

        $this->assertIsArray($specialFeeArray);
        $this->assertEquals("Special", $specialFeeArray['name']);
        $this->assertEquals(72.00, $specialFeeArray['value']);
    }
}