<?php

namespace App\Tests\Application\Service;

use App\Calculation\Application\Service\RuleService;
use App\Calculation\Infrastructure\Entity\Rules;
use App\Calculation\Infrastructure\Repository\RuleRepositoryInterface;
use PHPUnit\Framework\TestCase;

class RuleServiceTest extends TestCase
{
    public function testRuleServiceWithVechileTypeIdAndName()
    {
        $rule = new Rules();
        $rule->setAttributes(["max" => 50, "min" => 10, "percentage" => 10]);

        $ruleRepository = $this->createMock(RuleRepositoryInterface::class);
        $ruleRepository
            ->expects($this->once())
            ->method('findOneByVehicleTypeIdAndName')
            ->willReturn($rule)
        ;

        $ruleService = new RuleService($ruleRepository);

        $rule = $ruleService->getRuleAttributes(1, "Basic");

        $this->assertIsArray($rule);
        $this->assertEquals(10, $rule['percentage']);
        $this->assertEquals(50, $rule['max']);
        $this->assertEquals(10, $rule['min']);
    }

    public function testRuleServiceWithName()
    {
        $rule = new Rules();
        $rule->setAttributes(["value" => 100]);

        $ruleRepository = $this->createMock(RuleRepositoryInterface::class);
        $ruleRepository
            ->expects($this->once())
            ->method('findOneByName')
            ->willReturn($rule)
        ;

        $ruleService = new RuleService($ruleRepository);

        $rule = $ruleService->getRuleAttributes(null, "Storage");

        $this->assertIsArray($rule);
        $this->assertEquals(100, $rule['value']);
    }
}