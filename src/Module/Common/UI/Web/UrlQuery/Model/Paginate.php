<?php

declare(strict_types=1);

namespace Eagle\Module\Common\UI\Web\UrlQuery\Model;

class Paginate
{
    private const DEFAULT_CURRENT_PAGE = 1;
    private const DEFAULT_PAGE_SIZE = 20;

    private int $currentPage;

    private int $pageSize;

    public function __construct(int $currentPage, int $pageSize)
    {
        $this->setCurrentPage($currentPage);
        $this->setPageSize($pageSize);
    }

    public function currentPage(): int
    {
        return $this->currentPage;
    }

    private function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage > 0 ? $currentPage : self::DEFAULT_CURRENT_PAGE;
    }

    public function pageSize(): int
    {
        return $this->pageSize;
    }

    private function setPageSize(int $pageSize): void
    {
        $this->pageSize = $pageSize > 0 ? $pageSize : self::DEFAULT_PAGE_SIZE;
    }

    public function offset(): int
    {
        return $this->pageSize() * $this->currentPage() - $this->pageSize();
    }
}