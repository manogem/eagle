<?php

declare(strict_types=1);


namespace Eagle\Tests\Unit\Module\Common\UI\Web\UrlQuery\Factory;

use Eagle\Module\Common\UI\Web\UrlQuery\Factory\SortFactory;
use Eagle\Module\Measurement\UI\Web\UrlQuery\Enum\GetSubjectsWithLatestMeasurementsSortKey;
use Eagle\Tests\Unit\Module\Common\TestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class SortFactoryTest extends MockeryTestCase
{
    public function testItCreatesFromRequest(): void
    {
        $factory = new SortFactory();
        $sort = $factory->create(GetSubjectsWithLatestMeasurementsSortKey::class)
            ->fromRequest(TestObjectMother::sortRequest('subject_name'));

        $this->assertEquals($sort, TestObjectMother::sort(GetSubjectsWithLatestMeasurementsSortKey::class, 'subject_name'));
    }
}