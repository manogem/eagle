<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Infrastructure\Write;

use Doctrine\ORM\EntityManagerInterface;
use Eagle\Module\Measurement\Application\Write\MeasurementWriteRepositoryInterface;
use Eagle\Module\Measurement\Infrastructure\Entity\Measurement as MeasurementEntity;
use Eagle\Module\Measurement\Domain\Model\Measurement;

class DoctrineMeasurementWriteRepository implements MeasurementWriteRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(int $userId, Measurement $measurement): void
    {
        $measurementEntity = new MeasurementEntity();

        $measurementEntity
            ->setUserId($userId)
            ->setSubjectName($measurement->subjectName())
            ->setType($measurement->type()->getValue())
            ->setMeasurementTimestamp($measurement->timestamp())
            ->setPayload($measurement->payload());

        $this->entityManager->persist($measurementEntity);
    }
}