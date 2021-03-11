<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\Common\UI\Web\UrlQuery\Model;

use Eagle\Module\Measurement\UI\Web\UrlQuery\Enum\GetSubjectsWithLatestMeasurementsSortKey;
use Eagle\Tests\Unit\Module\Common\TestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class SortTest extends MockeryTestCase
{
    public function testModel(): void
    {
        $sort = TestObjectMother::sort(GetSubjectsWithLatestMeasurementsSortKey::class, 'subject_name');

        $this->assertEquals('subject_name', $sort->key());
        $this->assertEquals('DESC', $sort->direction());
    }
}