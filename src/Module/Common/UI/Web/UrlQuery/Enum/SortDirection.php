<?php

declare(strict_types=1);

namespace Eagle\Module\Common\UI\Web\UrlQuery\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static SortDirection ASC()
 * @method static SortDirection DESC()
 */
class SortDirection extends Enum
{
    private const ASC = 'ASC';
    private const DESC = 'DESC';
}