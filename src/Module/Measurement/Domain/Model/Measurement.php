<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Domain\Model;

use DateTimeImmutable;
use Eagle\Module\Measurement\Domain\Enum\MeasurementType;

class Measurement
{
    private string $subjectName;

    private MeasurementType $type;

    private DateTimeImmutable $timestamp;

    private string $payload;

    public function __construct(
        string $subjectName,
        MeasurementType $type,
        DateTimeImmutable $timestamp,
        string $payload
    ) {
        $this->subjectName = $subjectName;
        $this->type = $type;
        $this->timestamp = $timestamp;
        $this->payload = $payload;
    }

    public function subjectName(): string
    {
        return $this->subjectName;
    }

    public function type(): MeasurementType
    {
        return $this->type;
    }

    public function timestamp(): DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function payload(): string
    {
        return $this->payload;
    }
}