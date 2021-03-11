<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\Measurement;

use Eagle\Module\Measurement\Application\Read\Dto\MeasurementDto;
use Eagle\Module\Measurement\Application\Read\Dto\SubjectDto;
use Eagle\Module\Measurement\Domain\Enum\MeasurementType;
use Eagle\Module\Measurement\Domain\Model\Measurement;
use Eagle\Module\Measurement\UI\Web\Request\MeasurementRequest;
use DateTimeImmutable;

class TestObjectMother
{
    public static function measurementModel(): Measurement
    {
        return new Measurement(
            'name',
            MeasurementType::MEASURED_HUMIDITY(),
            new DateTimeImmutable('2020-10-10 00:00:00'),
            'payload'
        );
    }

    public static function measurementRequest(): MeasurementRequest
    {
        $measurementRequest = new MeasurementRequest();
        $measurementRequest->subjectName = 'name';
        $measurementRequest->type = MeasurementType::MEASURED_HUMIDITY()->getValue();
        $measurementRequest->timestamp = '2020-10-10 00:00:00';
        $measurementRequest->payload = 'payload';

        return $measurementRequest;
    }

    public static function measurementDto(): MeasurementDto
    {
        $measurementDto = new MeasurementDto();
        $measurementDto->type = (new MeasurementType((int) 1))->getKey();
        $measurementDto->timestamp = new DateTimeImmutable('2020-01-01 22:20:20');
        $measurementDto->payload = 'payload';

        return $measurementDto;
    }

    public static function subjectsWithMeasurementsData(): array
    {
        $subjectWithMeasurementsData['subject'] = [
            [
                'type' => 1,
                'measurement_timestamp' => '2020-01-01 22:20:20',
                'payload' => 'payload'
            ]
        ];

        return $subjectWithMeasurementsData;
    }

    public static function subjectWithMeasurements(): SubjectDto
    {
        $subjectDto = new SubjectDto();
        $subjectDto->name = 'subject';
        $subjectDto->measurements = [self::measurementDto()];

        return $subjectDto;
    }

    public static function subjectsWithMeasurements(): array
    {
        return [self::subjectWithMeasurements()];
    }
}