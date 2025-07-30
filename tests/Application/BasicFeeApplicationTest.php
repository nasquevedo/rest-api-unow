<?php

namespace App\Tests\Application;

use App\Calculation\Application\BasicFeeApplication;
use App\Calculation\Application\Service\CalculateService;
use App\Calculation\Application\Service\RuleService;
use App\Calculation\Application\Service\RuleServiceInterface;
use App\Calculation\Infrastructure\Repository\RuleRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

class BasicFeeApplicationTest extends TestCase
{
    public function testBasicFeeCommon()
    {
        $ruleService = $this->createMock(RuleServiceInterface::class);

        $ruleService
            ->expects($this->once())
            ->method('getRuleAttributes')
            ->willReturn([
                "percentage" => 10,
                "min" => 10,
                "max" => 50
            ])
        ;

        $calculateService = $this->createMock(CalculateService::class);

        $calculateService
            ->expects($this->once())
            ->method('getValueByPercentage')
            ->willReturn(39.80)
        ;

        $basicFeeApp = new BasicFeeApplication($ruleService, $calculateService);
        $basicFee = $basicFeeApp->getBasicFee(398, 1);
        $basicFeeArray = $basicFee->getArray();

        $this->assertIsArray($basicFeeArray);
        $this->assertEquals('Basic', $basicFeeArray['name']);
        $this->assertEquals(39.80, $basicFeeArray['value']);
    }

    public function testBasicFeeLuxury()
    {
        $ruleService = $this->createMock(RuleServiceInterface::class);

        $ruleService
            ->expects($this->once())
            ->method('getRuleAttributes')
            ->willReturn([
                "percentage" => 10,
                "min" => 25,
                "max" => 200
            ])
        ;

        $calculateService = $this->createMock(CalculateService::class);

        $calculateService
            ->expects($this->once())
            ->method('getValueByPercentage')
            ->willReturn(180.00)
        ;

        $basicFeeApp = new BasicFeeApplication($ruleService, $calculateService);
        $basicFee = $basicFeeApp->getBasicFee(1800, 1);
        $basicFeeArray = $basicFee->getArray();

        $this->assertIsArray($basicFeeArray);
        $this->assertEquals('Basic', $basicFeeArray['name']);
        $this->assertEquals(180.00, $basicFeeArray['value']);
    }
}