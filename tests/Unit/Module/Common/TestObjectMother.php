<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\Common;

use Eagle\Module\Common\UI\Web\UrlQuery\Factory\PaginateFactory;
use Eagle\Module\Common\UI\Web\UrlQuery\Factory\SortFactory;
use Eagle\Module\Common\UI\Web\UrlQuery\Model\Paginate;
use Eagle\Module\Common\UI\Web\UrlQuery\Model\Sort;
use Symfony\Component\HttpFoundation\Request;


class TestObjectMother
{
    public static function sortRequest($key)
    {
        $request = new Request();
        $request->query->set(SortFactory::REQUEST_KEY_PARAMETER, $key);
        $request->query->set(SortFactory::REQUEST_DIRECTION_PARAMETER, 'DESC');

        return $request;
    }

    public static function sort($directory, $key): Sort
    {
        $sort = new Sort($directory);
        $sort->setKey($key);
        $sort->setDirection('DESC');

        return $sort;
    }

    public static function paginateRequest()
    {
        $request = new Request();
        $request->query->set(PaginateFactory::REQUEST_PAGE_PARAMETER, 1);
        $request->query->set(PaginateFactory::REQUEST_PAGE_SIZE_PARAMETER, 10);

        return $request;
    }

    public static function paginate(): Paginate
    {
        return new Paginate(1, 10);
    }
}