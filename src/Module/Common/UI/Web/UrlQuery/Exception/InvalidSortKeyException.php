<?php

declare(strict_types=1);

namespace Eagle\Module\Common\UI\Web\UrlQuery\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidSortKeyException extends Exception
{
    public function __construct(string $availableSortKeys = "")
    {
        $message = 'Provide appropriate sort key: [' . $availableSortKeys . ']';

        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}