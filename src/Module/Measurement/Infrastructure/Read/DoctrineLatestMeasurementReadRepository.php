<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Infrastructure\Read;

use Doctrine\DBAL\Connection;
use Eagle\Module\Common\UI\Web\UrlQuery\Model\Paginate;
use Eagle\Module\Common\UI\Web\UrlQuery\Model\Sort;
use Eagle\Module\Measurement\Application\Read\LatestMeasurementReadRepositoryInterface;
use Eagle\Module\Measurement\Infrastructure\Read\Factory\MeasurementDtoFactory;

class DoctrineLatestMeasurementReadRepository implements LatestMeasurementReadRepositoryInterface
{
    private Connection $conn;

    private MeasurementDtoFactory $factory;

    public function __construct(Connection $conn, MeasurementDtoFactory $factory)
    {
        $this->conn = $conn;
        $this->factory = $factory;
    }

    public function getSubjectsWithLatestMeasurements(int $userId, Sort $sort, Paginate $paginate): array
    {
        $subjects = $this->getSubjects($userId, $sort, $paginate);
        $measurements = $this->getLatestMeasurements($userId, $sort);

        if (!$subjects) {
            return [];
        }

        return $this->factory->createSubjectsWithLatestMeasurements($subjects, $measurements);
    }

    public function getSubjectsCountTotal(int $userId): int
    {
        return $this->conn->createQueryBuilder()
            ->select('s.id')
            ->from('latest_measurement', 's')
            ->where('s.user_id = :userId')
            ->groupBy('s.subject_name')
            ->setParameter('userId', $userId)
            ->execute()
            ->rowCount();
    }

    private function getSubjects(int $userId, Sort $sort, Paginate $paginate): array
    {
        return $this->conn->createQueryBuilder()
            ->select('s.subject_name as name')
            ->from('latest_measurement', 's')
            ->where('s.user_id = :userId')
            ->setFirstResult($paginate->offset())
            ->setMaxResults($paginate->pageSize())
            ->orderBy($sort->key(), $sort->direction())
            ->groupBy('s.subject_name')
            ->setParameter('userId', $userId)
            ->execute()
            ->fetchAllAssociative();
    }

    private function getLatestMeasurements(int $userId, Sort $sort): array
    {
        return $this->conn->createQueryBuilder()
            ->select(
                's.subject_name',
                's.type',
                's.measurement_timestamp',
                's.payload'
            )
            ->from('latest_measurement', 's')
            ->andWhere('s.user_id = :userId')
            ->orderBy($sort->key(), $sort->direction())
            ->orderBy('type', 'ASC')
            ->setParameter('userId', $userId)
            ->execute()
            ->fetchAllAssociative();
    }
}