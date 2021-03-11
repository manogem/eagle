<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Application\Read;

use Eagle\Module\Common\UI\Web\UrlQuery\Model\Paginate;
use Eagle\Module\Common\UI\Web\UrlQuery\Model\Sort;
use Eagle\Module\Measurement\Application\Read\Dto\SubjectDto;

interface LatestMeasurementReadRepositoryInterface
{
    public function getSubjectsCountTotal(int $userId): int;

    /**
     * @return SubjectDto[] | array
     */
    public function getSubjectsWithLatestMeasurements(int $userId, Sort $sort, Paginate $paginate): array;
}