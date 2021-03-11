<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Infrastructure\Read\Factory;

use DateTimeImmutable;
use Eagle\Module\Measurement\Application\Read\Dto\SubjectDto;
use Eagle\Module\Measurement\Application\Read\Dto\MeasurementDto;
use Eagle\Module\Measurement\Domain\Enum\MeasurementType;

class MeasurementDtoFactory
{
    public function createSubjectsWithLatestMeasurements(array $subjectsData, array $measurementsData): array
    {
        $subjectsWithLatestMeasurements = [];

        foreach ($subjectsData as $subject) {
            $subjectDto = new SubjectDto();
            $subjectDto->name = $subject['name'];

            $measurements = [];
            foreach ($measurementsData as $measurement) {
                if ($measurement['subject_name'] === $subject['name']) {
                    $measurements[] = $this->createMeasurement($measurement);
                }
            }
            $subjectDto->measurements = $measurements;

            $subjectsWithLatestMeasurements[] = $subjectDto;
        }

        return $subjectsWithLatestMeasurements;
    }

    private function createMeasurement(array $measurement): MeasurementDto
    {
        $measurementDto = new MeasurementDto();
        $measurementDto->type = (new MeasurementType((int) $measurement['type']))->getKey();
        $measurementDto->timestamp = new DateTimeImmutable($measurement['measurement_timestamp']);
        $measurementDto->payload = $measurement['payload'];

        return $measurementDto;
    }
}