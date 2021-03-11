<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\User\Domain\Model;

use Eagle\Tests\Unit\Module\User\TestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class UserTest extends MockeryTestCase
{
    public function testModel(): void
    {
        $user = TestObjectMother::userModel();

        $this->assertEquals('username', $user->username());
        $this->assertEquals('user@email.com', $user->email());
        $this->assertEquals('password', $user->password());
        $this->assertEquals(['ROLE_USER'], $user->roles());
        $this->assertEquals(true, $user->isActive());
    }
}