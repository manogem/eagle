<?php

declare(strict_types=1);

namespace Eagle\Module\Common\UI\Web\UrlQuery\Factory;

use Eagle\Module\Common\UI\Web\UrlQuery\Model\Paginate;
use Symfony\Component\HttpFoundation\Request;

class PaginateFactory
{
    public const REQUEST_PAGE_PARAMETER = 'page';
    public const REQUEST_PAGE_SIZE_PARAMETER = 'pageSize';

    public function fromRequest(Request $request): Paginate
    {
        return new Paginate(
            $request->query->getInt(self::REQUEST_PAGE_PARAMETER),
            $request->query->getInt(self::REQUEST_PAGE_SIZE_PARAMETER)
        );
    }
}