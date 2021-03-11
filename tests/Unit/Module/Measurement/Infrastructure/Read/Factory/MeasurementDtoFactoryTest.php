<?php

declare(strict_types=1);


namespace Eagle\Tests\Unit\Module\Measurement\Infrastructure\Read\Factory;

use Eagle\Module\Measurement\Infrastructure\Read\Factory\MeasurementDtoFactory;
use Eagle\Tests\Unit\Module\Measurement\TestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class MeasurementDtoFactoryTest extends MockeryTestCase
{
    public function testItCreatesSubjectsWithLatestMeasurements(): void
    {
        $factory = new MeasurementDtoFactory();
        $subjectsWithLatestMeasurements = $factory->createSubjectsWithLatestMeasurements(TestObjectMother::subjectsWithMeasurementsData());

        $this->assertEquals($subjectsWithLatestMeasurements, TestObjectMother::subjectsWithMeasurements());
    }
}