<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Infrastructure\Write;

use Doctrine\ORM\EntityManagerInterface;
use Eagle\Module\Measurement\Application\Write\LatestMeasurementWriteRepositoryInterface;
use Eagle\Module\Measurement\Infrastructure\Entity\LatestMeasurement as LatestMeasurementEntity;
use Eagle\Module\Measurement\Domain\Model\Measurement;

class DoctrineLatestMeasurementWriteRepository implements LatestMeasurementWriteRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(int $userId, Measurement $measurement): void
    {
        $latestMeasurementEntity = $this->getLatestMeasurementEntity($userId, $measurement);

        if ($latestMeasurementEntity && !$this->isLatestMeasurement($measurement, $latestMeasurementEntity)) {
            return;
        }

        if (empty($latestMeasurementEntity)) {
            $latestMeasurementEntity = new LatestMeasurementEntity();
        }

        $latestMeasurementEntity
            ->setUserId($userId)
            ->setSubjectName($measurement->subjectName())
            ->setType($measurement->type()->getValue())
            ->setMeasurementTimestamp($measurement->timestamp())
            ->setPayload($measurement->payload());

        $this->entityManager->persist($latestMeasurementEntity);
    }

    private function getLatestMeasurementEntity(int $userId, Measurement $measurement): ?LatestMeasurementEntity
    {
        return $this->entityManager->getRepository(LatestMeasurementEntity::class)
            ->findOneBy([
                'userId' => $userId,
                'subjectName' => $measurement->subjectName(),
                'type' => $measurement->type()->getValue()
            ]);
    }

    private function isLatestMeasurement(Measurement $measurement, LatestMeasurementEntity $latestMeasurementEntity): bool
    {
        return $latestMeasurementEntity->getMeasurementTimestamp() <= $measurement->timestamp();
    }
}