<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Application\Write;

use Eagle\Module\Measurement\Domain\Model\Measurement;

interface LatestMeasurementWriteRepositoryInterface
{
    public function save(int $userId, Measurement $measurement): void;
}