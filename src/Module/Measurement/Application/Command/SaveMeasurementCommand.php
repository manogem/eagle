<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Application\Command;

use Eagle\Module\Measurement\Domain\Model\Measurement;

class SaveMeasurementCommand
{
    private int $userId;

    private Measurement $measurement;

    public function __construct(int $userId, Measurement $measurement)
    {
        $this->userId = $userId;
        $this->measurement = $measurement;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function measurement(): Measurement
    {
        return $this->measurement;
    }
}