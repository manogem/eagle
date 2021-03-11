<?php

declare(strict_types=1);


namespace Eagle\Tests\Unit\Module\Common\UI\Web\UrlQuery\Factory;

use Eagle\Module\Common\UI\Web\UrlQuery\Factory\PaginateFactory;
use Eagle\Tests\Unit\Module\Common\TestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class PaginateFactoryTest extends MockeryTestCase
{
    public function testItCreatesFromRequest(): void
    {
        $factory = new PaginateFactory();
        $paginate = $factory->fromRequest(TestObjectMother::paginateRequest());

        $this->assertEquals($paginate, TestObjectMother::paginate());
    }
}