<?php

declare(strict_types=1);

namespace Eagle\Module\Common\UI\Web\UrlQuery\Model;

use Eagle\Module\Common\UI\Web\UrlQuery\Enum\SortDirection;
use Eagle\Module\Common\UI\Web\UrlQuery\Exception\InvalidSortDirectionException;
use Eagle\Module\Common\UI\Web\UrlQuery\Exception\InvalidSortKeyException;
use UnexpectedValueException;

class Sort
{
    private string $sortDictionary;

    private string $key;

    private string $direction;

    public function __construct(string $sortDictionary)
    {
        $this->sortDictionary = $sortDictionary;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function setKey(?string $key): void
    {
        try {
            $this->key = (new $this->sortDictionary($key ?? $this->sortDictionary::__default))->getValue();
        } catch (UnexpectedValueException $exception) {
            throw new InvalidSortKeyException(implode(', ', array_unique(array_values($this->sortDictionary::toArray()))));
        }
    }

    public function direction(): string
    {
        return $this->direction;
    }

    public function setDirection(?string $direction): void
    {
        try {
            $this->direction = (new SortDirection($direction ?? SortDirection::DESC()))->getKey();
        }  catch (UnexpectedValueException $exception) {
            throw new InvalidSortDirectionException(implode(', ', array_unique(array_values(SortDirection::toArray()))));
        }
    }
}