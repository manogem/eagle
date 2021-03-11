<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\Measurement\Application\Write\Command\Handler;

use Eagle\Module\Measurement\Application\Command\SaveMeasurementCommand;
use Eagle\Module\Measurement\Application\Command\Handler\SaveMeasurementCommandHandler;
use Eagle\Module\Measurement\Application\Write\LatestMeasurementWriteRepositoryInterface;
use Eagle\Module\Measurement\Application\Write\MeasurementWriteRepositoryInterface;
use Eagle\Tests\Unit\Module\Measurement\TestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery;

class SaveMeasurementCommandHandlerTest extends MockeryTestCase
{
    public function testHandler(): void
    {
        $userId = 1;

        $measurement = TestObjectMother::measurementModel();

        $latestMeasurementInterface = Mockery::mock(LatestMeasurementWriteRepositoryInterface::class);
        $latestMeasurementInterface
            ->shouldReceive('get')
            ->once()
            ->andReturnNull();

        $latestMeasurementInterface
            ->shouldReceive('save')
            ->once()
            ->andReturnNull();

        $measurementInterface = Mockery::mock(MeasurementWriteRepositoryInterface::class);


        $command = new SaveMeasurementCommand($userId, $measurement);
        $handler = new SaveMeasurementCommandHandler($latestMeasurementInterface, $measurementInterface);

        $handler->__invoke($command);
    }
}