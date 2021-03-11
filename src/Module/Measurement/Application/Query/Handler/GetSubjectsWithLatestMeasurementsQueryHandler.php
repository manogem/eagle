<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Application\Query\Handler;

use Eagle\Module\Common\Application\MessageHandler\QueryHandlerInterface;
use Eagle\Module\Common\Application\Read\Dto\QueryCollectionResponseDto;
use Eagle\Module\Measurement\Application\Query\GetSubjectsWithLatestMeasurementsQuery;
use Eagle\Module\Measurement\Application\Read\LatestMeasurementReadRepositoryInterface;

class GetSubjectsWithLatestMeasurementsQueryHandler implements QueryHandlerInterface
{
    private LatestMeasurementReadRepositoryInterface $measurementRepository;

    public function __construct(LatestMeasurementReadRepositoryInterface $measurementRepository)
    {
        $this->measurementRepository = $measurementRepository;
    }

    public function __invoke(GetSubjectsWithLatestMeasurementsQuery $getLatestMeasurementListQuery)
    {
        return new QueryCollectionResponseDto(
            $this->measurementRepository->getSubjectsWithLatestMeasurements(
                $getLatestMeasurementListQuery->userId(),
                $getLatestMeasurementListQuery->sort(),
                $getLatestMeasurementListQuery->paginate()
            ),
            $this->measurementRepository->getSubjectsCountTotal($getLatestMeasurementListQuery->userId())
        );
    }
}