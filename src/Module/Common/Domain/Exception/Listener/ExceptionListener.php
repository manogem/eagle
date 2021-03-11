<?php

declare(strict_types=1);

namespace Eagle\Module\Common\Domain\Exception\Listener;

use Eagle\Module\Common\UI\Web\Controller\ApiController;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class ExceptionListener extends ApiController
{
    private LoggerInterface $logger;

    private int $statusCode;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onKernelException(ExceptionEvent $event):void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        switch (true) {
            case $exception instanceof UniqueConstraintViolationException:
                $this->statusCode = Response::HTTP_BAD_REQUEST;
                break;
            default:
                $this->statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                break;
        }

        $this->logger->error($exception);

        $event->setResponse($this->respondWithErrors($this->statusCode, [$exception->getMessage()]));
    }
}