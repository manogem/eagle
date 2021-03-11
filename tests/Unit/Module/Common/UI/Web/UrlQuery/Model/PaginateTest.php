<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\Common\UI\Web\UrlQuery\Model;

use Eagle\Tests\Unit\Module\Common\TestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class PaginateTest extends MockeryTestCase
{
    public function testModel(): void
    {
        $paginate = TestObjectMother::paginate();

        $this->assertEquals(1, $paginate->currentPage());
        $this->assertEquals(10, $paginate->pageSize());
    }
}