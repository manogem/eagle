<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\Measurement\Application\Write\Command\Handler;

use Eagle\Module\Measurement\Application\Query\GetSubjectsWithLatestMeasurementsQuery;
use Eagle\Module\Measurement\Application\Query\Handler\GetSubjectsWithLatestMeasurementsQueryHandler;
use Eagle\Module\Measurement\Application\Read\LatestMeasurementReadRepositoryInterface;
use Eagle\Module\Measurement\UI\Web\UrlQuery\Enum\GetSubjectsWithLatestMeasurementsSortKey;
use Eagle\Tests\Unit\Module\Common\TestObjectMother as CommonTestObjectMother;
use Eagle\Tests\Unit\Module\Measurement\TestObjectMother as MeasurementTestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery;

class GetSubjectsWithLatestMeasurementsQueryHandlerTest extends MockeryTestCase
{
    public function testHandler(): void
    {
        $userId = 1;

        $measurementInterface = Mockery::mock(LatestMeasurementReadRepositoryInterface::class);
        $measurementInterface
            ->shouldReceive('getSubjectsCountTotal')
            ->once()
            ->andReturn(3);

        $measurementInterface
            ->shouldReceive('getSubjectsWithLatestMeasurements')
            ->once()
            ->andReturn(MeasurementTestObjectMother::subjectsWithMeasurements());

        $query = new GetSubjectsWithLatestMeasurementsQuery(
            $userId,
            CommonTestObjectMother::sort(GetSubjectsWithLatestMeasurementsSortKey::class, 'subject_name'),
            CommonTestObjectMother::paginate()
        );
        $handler = new GetSubjectsWithLatestMeasurementsQueryHandler($measurementInterface);

        $handler->__invoke($query);
    }
}