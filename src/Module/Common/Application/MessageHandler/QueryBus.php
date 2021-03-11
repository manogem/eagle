<?php

declare(strict_types=1);

namespace Eagle\Module\Common\Application\MessageHandler;

use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function run($query)
    {
        try {
            return $this->handle($query);
        } catch (HandlerFailedException $exception) {
            throw $exception->getPrevious();
        }
    }
}