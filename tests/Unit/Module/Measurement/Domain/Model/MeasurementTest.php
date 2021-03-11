<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\Measurement\Domain\Model;

use DateTimeImmutable;
use Eagle\Module\Measurement\Domain\Enum\MeasurementType;
use Eagle\Tests\Unit\Module\Measurement\TestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class MeasurementTest extends MockeryTestCase
{
    public function testModel(): void
    {
        $measurement = TestObjectMother::measurementModel();

        $this->assertEquals('name', $measurement->subjectName());
        $this->assertEquals(MeasurementType::MEASURED_HUMIDITY(), $measurement->type());
        $this->assertEquals(new DateTimeImmutable('2020-10-10 00:00:00'), $measurement->timestamp());
        $this->assertEquals('payload', $measurement->payload());
    }
}