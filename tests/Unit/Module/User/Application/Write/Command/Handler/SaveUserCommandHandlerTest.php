<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\User\Application\Write\Command\Handler;

use Eagle\Module\User\Application\Command\Handler\SaveUserCommandHandler;
use Eagle\Module\User\Application\Command\SaveUserCommand;
use Eagle\Module\User\Application\Write\UserWriteRepositoryInterface;
use Eagle\Tests\Unit\Module\User\TestObjectMother;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery;

class SaveUserCommandHandlerTest extends MockeryTestCase
{
    public function testHandler(): void
    {
        $user = TestObjectMother::userModel();

        $measurementInterface = Mockery::mock(UserWriteRepositoryInterface::class);
        $measurementInterface
            ->shouldReceive('save')
            ->once()
            ->andReturnNull();

        $command = new SaveUserCommand($user);
        $handler = new SaveUserCommandHandler($measurementInterface);

        $handler->__invoke($command);
    }
}