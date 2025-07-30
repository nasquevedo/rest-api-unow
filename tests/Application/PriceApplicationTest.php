<?php

namespace App\Tests\Application;

use App\Calculation\Application\AssociationFeeApplicationInterface;
use App\Calculation\Application\BasicFeeApplicationInterface;
use App\Calculation\Application\FeesApplicationInterface;
use App\Calculation\Application\PriceApplication;
use App\Calculation\Application\Service\CalculateServiceInterface;
use App\Calculation\Application\SpecialFeeApplicationInterface;
use App\Calculation\Application\StorageFeeApplicationInterface;
use App\Calculation\Domain\Model\FeeModel;
use App\Calculation\Domain\Model\FeesModel;
use App\Calculation\Infrastructure\Entity\VehicleType;
use App\Calculation\Infrastructure\Repository\VehicleTypeRepositoryInterface;
use PHPUnit\Framework\TestCase;

class PriceApplicationTest extends TestCase
{
    public function testPriceCorrectTotal()
    {
        $vehicleType = new VehicleType();
        $vehicleType->setName('Common');

        $vehicleTypeRepository = $this->createMock(VehicleTypeRepositoryInterface::class);
        $vehicleTypeRepository
            ->expects($this->once())
            ->method('findById')
            ->willReturn($vehicleType)
        ;

        $basicFeeApp = $this->createMock(BasicFeeApplicationInterface::class);
        $basicFeeApp
            ->expects($this->once())
            ->method('getbasicFee')
            ->willReturn(new FeeModel('Basic', 39.80))
        ;

        $specialFeeApp = $this->createMock(SpecialFeeApplicationInterface::class);
        $specialFeeApp
            ->expects($this->once())
            ->method('getSpecialFee')
            ->willReturn(new FeeModel('Special', 7.96))
        ;

        $associationFeeApp = $this->createMock(AssociationFeeApplicationInterface::class);
            
        $associationFeeApp
            ->expects($this->once())
            ->method('getAssociationFee')
            ->willReturn(new FeeModel('Association', 5.00))
        ;
        
        $storageFeeApp = $this->createMock(StorageFeeApplicationInterface::class);
        $storageFeeApp
            ->expects($this->once())
            ->method('getStorageFee')
            ->willReturn(new FeeModel('Storage', 100))
        ;

        $basicFeeArray = ["name" => "Basic", "value" => 39.80]; 
        $specialFeeArray = ["name" => "Special", "value" => 7.96]; 
        $associationFeeArray = ["name" => "Association", "value" => 5.0]; 
        $storageFeeArray = ["name" => "Storage", "value" => 100.0];

        $feesApp = $this->createMock(FeesApplicationInterface::class);
        $feesApp
            ->expects($this->once())
            ->method('getFees')
            ->willReturn(new FeesModel(
                $basicFeeArray,
                $specialFeeArray,
                $associationFeeArray,
                $storageFeeArray
            ))
        ;

        $calculateService = $this->createMock(CalculateServiceInterface::class);
        $calculateService
            ->expects($this->once())
            ->method('getTotalFees')
            ->willReturn(152.76)
        ;
        $calculateService
            ->expects($this->once())
            ->method('getTotal')
            ->willReturn(550.76)
        ;

        $priceApp = new PriceApplication(
            $vehicleTypeRepository,
            $basicFeeApp,
            $specialFeeApp,
            $associationFeeApp,
            $storageFeeApp,
            $feesApp,
            $calculateService
        );

        $price = $priceApp->getPrice(398, 1);

        $this->assertIsArray($price);
    }
}