<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\UI\Web\Controller;

use DateTimeImmutable;
use Eagle\Module\Common\Application\MessageHandler\CommandBus;
use Eagle\Module\Common\Application\MessageHandler\QueryBus;
use Eagle\Module\Common\UI\Web\Controller\ApiController;
use Eagle\Module\Common\UI\Web\UrlQuery\Exception\InvalidSortDirectionException;
use Eagle\Module\Common\UI\Web\UrlQuery\Exception\InvalidSortKeyException;
use Eagle\Module\Common\UI\Web\UrlQuery\Factory\PaginateFactory;
use Eagle\Module\Common\UI\Web\UrlQuery\Factory\SortFactory;
use Eagle\Module\Measurement\Application\Command\SaveMeasurementCommand;
use Eagle\Module\Measurement\Application\Query\GetSubjectsWithLatestMeasurementsQuery;
use Eagle\Module\Measurement\Domain\Enum\MeasurementType;
use Eagle\Module\Measurement\Domain\Model\Measurement;
use Eagle\Module\Measurement\UI\Web\Form\MeasurementForm;
use Eagle\Module\Measurement\UI\Web\Request\MeasurementRequest;
use Eagle\Module\Measurement\UI\Web\UrlQuery\Enum\GetSubjectsWithLatestMeasurementsSortKey;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MeasurementController extends ApiController
{
    private CommandBus $commandBus;

    private QueryBus $queryBus;

    private LoggerInterface $logger;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus, LoggerInterface $logger)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
        $this->logger = $logger;
    }

    public function create(Request $request)
    {
        $measurementRequest = new MeasurementRequest();

        $form = $this->createForm(MeasurementForm::class, $measurementRequest);
        $form->submit($this->getJsonBody($request));

        if ($form->isValid()) {
            $this->commandBus->run(
                new SaveMeasurementCommand(
                    $this->getUser()->getId(),
                    new Measurement(
                        $form->getData()->subjectName,
                        new MeasurementType($form->getData()->type),
                        new DateTimeImmutable($form->getData()->timestamp),
                        $form->getData()->payload
                    )
                )
            );

            return $this->respond(Response::HTTP_CREATED);
        }

        return $this->respondWithErrors(Response::HTTP_BAD_REQUEST, $this->getFormErrors($form));
    }

    public function getSubjectsLatestMeasurement(Request $request, SortFactory $sortFactory, PaginateFactory $paginateFactory)
    {
        try {
            $queryResult = $this->queryBus->run(
                new GetSubjectsWithLatestMeasurementsQuery(
                    $this->getUser()->getId(),
                    $sortFactory->create(GetSubjectsWithLatestMeasurementsSortKey::class)->fromRequest($request),
                    $paginate = $paginateFactory->fromRequest($request)
                )
            );
        } catch (InvalidArgumentException | InvalidSortDirectionException | InvalidSortKeyException $exception) {
            return $this->respondWithErrors(Response::HTTP_BAD_REQUEST, [$exception->getMessage()]);
        }

        return $this->respondWithData(Response::HTTP_OK, $queryResult->data, $this->metadata($queryResult->totalCount));
    }
}
