<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Domain\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static MeasurementType MEASURED_HUMIDITY()
 * @method static MeasurementType MEASURED_LIGHT()
 * @method static MeasurementType MEASURED_PRESSURE()
 * @method static MeasurementType MEASURED_TEMPERATURE()
 * @method static MeasurementType MEASURED_MOISTURE()
 */
class MeasurementType extends Enum
{
    private const MEASURED_HUMIDITY = 1;
    private const MEASURED_LIGHT = 2;
    private const MEASURED_PRESSURE = 3;
    private const MEASURED_TEMPERATURE = 4;
    private const MEASURED_MOISTURE = 5;
}