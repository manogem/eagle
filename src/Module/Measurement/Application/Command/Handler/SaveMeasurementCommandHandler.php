<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Application\Command\Handler;

use Eagle\Module\Common\Application\MessageHandler\CommandHandlerInterface;
use Eagle\Module\Measurement\Application\Command\SaveMeasurementCommand;
use Eagle\Module\Measurement\Application\Write\MeasurementWriteRepositoryInterface;
use Eagle\Module\Measurement\Application\Write\LatestMeasurementWriteRepositoryInterface;
use Eagle\Module\Measurement\Domain\Model\Measurement;

class SaveMeasurementCommandHandler implements CommandHandlerInterface
{
    private LatestMeasurementWriteRepositoryInterface $latestMeasurementRepository;

    private MeasurementWriteRepositoryInterface $measurementRepository;

    public function __construct(
        LatestMeasurementWriteRepositoryInterface $latestMeasurementRepository,
        MeasurementWriteRepositoryInterface $measurementRepository
    ) {
        $this->latestMeasurementRepository = $latestMeasurementRepository;
        $this->measurementRepository = $measurementRepository;
    }

    public function __invoke(SaveMeasurementCommand $createMeasurementCommand)
    {
        $this->save($createMeasurementCommand->userId(), $createMeasurementCommand->measurement());
    }

    private function save(int $userId, Measurement $measurement)
    {
        $this->measurementRepository->save($userId, $measurement);
        $this->latestMeasurementRepository->save($userId, $measurement);
    }
}