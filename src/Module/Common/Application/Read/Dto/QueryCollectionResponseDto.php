<?php

declare(strict_types=1);

namespace Eagle\Module\Common\Application\Read\Dto;

class QueryCollectionResponseDto
{
    public array $data;

    public int $totalCount;

    public function __construct(array $data, int $totalCount)
    {
        $this->data = $data;
        $this->totalCount = $totalCount;
    }
}