<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\UI\Web\UrlQuery\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static GetSubjectsWithLatestMeasurementsSortKey SUBJECT_NAME()
 */
class GetSubjectsWithLatestMeasurementsSortKey extends Enum
{
    public const __default = self::SUBJECT_NAME;

    private const SUBJECT_NAME = 'subject_name';
}