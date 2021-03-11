<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Application\Query;

use Eagle\Module\Common\UI\Web\UrlQuery\Model\Paginate;
use Eagle\Module\Common\UI\Web\UrlQuery\Model\Sort;

class GetSubjectsWithLatestMeasurementsQuery
{
    private int $userId;

    private Sort $sort;

    private Paginate $paginate;

    public function __construct(int $userId, Sort $sort, Paginate $paginate)
    {
        $this->userId = $userId;
        $this->sort = $sort;
        $this->paginate = $paginate;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function sort(): Sort
    {
        return $this->sort;
    }

    public function paginate(): Paginate
    {
        return $this->paginate;
    }
}