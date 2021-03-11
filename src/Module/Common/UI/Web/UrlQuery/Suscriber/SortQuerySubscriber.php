<?php

declare(strict_types=1);

namespace Eagle\Module\Common\UI\Web\UrlQuery\Request\Subscriber;

use Eagle\Module\Common\UI\Web\UrlQuery\Enum\SortDirection;
use Eagle\Module\Common\UI\Web\UrlQuery\Factory\SortFactory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class SortQuerySubscriber implements EventSubscriberInterface
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        $sort = $request->query->get('sort');

        switch ($sort[0] ?? null) {
            case ' ':
                $sortDirection = SortDirection::ASC();
                break;
            case '-':
                $sortDirection = SortDirection::DESC();
                break;
            default:
                $sortDirection = null;
                break;
        }

        if ($sortDirection) {
            $request->query->set(SortFactory::REQUEST_KEY_PARAMETER, substr($sort, 1));
            $request->query->set(SortFactory::REQUEST_DIRECTION_PARAMETER, $sortDirection->getValue());
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}