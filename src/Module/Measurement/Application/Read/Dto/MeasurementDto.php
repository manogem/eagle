<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Application\Read\Dto;

use DateTimeImmutable;

class MeasurementDto
{
    public string $type;

    public DateTimeImmutable $timestamp;

    public string $payload;
}