<?php

declare(strict_types=1);

namespace Eagle\Module\Common\UI\Web\UrlQuery\Factory;

use Eagle\Module\Common\UI\Web\UrlQuery\Model\Sort;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;

class SortFactory
{
    public const REQUEST_KEY_PARAMETER = 'sort';
    public const REQUEST_DIRECTION_PARAMETER = 'sortDirection';

    private string $sortDictionary;

    public function create(string $sortDictionary): self
    {
        if (!class_exists($sortDictionary)) {
            throw new InvalidArgumentException();
        }

        $this->sortDictionary = $sortDictionary;

        return $this;
    }

    public function fromRequest(Request $request): Sort
    {
        $sort = new Sort($this->sortDictionary);
        $sort->setKey($request->query->get(self::REQUEST_KEY_PARAMETER));
        $sort->setDirection($request->query->get(self::REQUEST_DIRECTION_PARAMETER));

        return $sort;
    }
}