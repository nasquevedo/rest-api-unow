<?php

namespace App\Tests\Application;

use App\Calculation\Application\Service\RuleServiceInterface;
use App\Calculation\Application\StorageFeeApplication;
use PHPUnit\Framework\TestCase;

class StorageFeeApplicationTest extends TestCase
{
    public function testStorageFee()
    {
        $ruleService = $this->createMock(RuleServiceInterface::class);

        $ruleService
            ->expects($this->once())
            ->method('getRuleAttributes')
            ->willReturn(["value" => 100])
        ;

        $storageFeeApplication = new StorageFeeApplication($ruleService);
        $storageFee = $storageFeeApplication->getStorageFee(398, 1);
        $storageFeeArray = $storageFee->getArray();

        $this->assertIsArray($storageFeeArray);
        $this->assertEquals("Storage", $storageFeeArray["name"]);
        $this->assertEquals(100, $storageFeeArray["value"]);
    }
}