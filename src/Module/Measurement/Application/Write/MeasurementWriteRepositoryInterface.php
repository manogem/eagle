<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Application\Write;

use Eagle\Module\Measurement\Domain\Model\Measurement;

interface MeasurementWriteRepositoryInterface
{
    public function save(int $userId, Measurement $measurement): void;
}