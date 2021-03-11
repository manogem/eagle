<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Infrastructure\Doctrine;

use Eagle\Module\Measurement\Infrastructure\Entity\LatestMeasurement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LatestMeasurement|null find($id, $lockMode = null, $lockVersion = null)
 * @method LatestMeasurement|null findOneBy(array $criteria, array $orderBy = null)
 * @method LatestMeasurement[]    findAll()
 * @method LatestMeasurement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LatestMeasurementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LatestMeasurement::class);
    }
}
