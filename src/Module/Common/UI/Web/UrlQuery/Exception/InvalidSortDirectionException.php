<?php

declare(strict_types=1);

namespace Eagle\Module\Common\UI\Web\UrlQuery\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidSortDirectionException extends Exception
{
    public function __construct(string $availableSortDirections = "")
    {
        $message = 'Provide appropriate sort direction: [' . $availableSortDirections . ']';

        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}