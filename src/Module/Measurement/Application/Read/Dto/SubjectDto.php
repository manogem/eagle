<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Application\Read\Dto;

class SubjectDto
{
    public string $name;

    /** @var MeasurementDto[] */
    public array $measurements;
}