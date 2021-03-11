<?php

declare(strict_types=1);

namespace Eagle\Module\User\Application\Command\Handler;

use Eagle\Module\Common\Application\MessageHandler\CommandHandlerInterface;
use Eagle\Module\User\Application\Command\SaveUserCommand;
use Eagle\Module\User\Application\Write\UserWriteRepositoryInterface;

class SaveUserCommandHandler implements CommandHandlerInterface
{
    private UserWriteRepositoryInterface $userRepository;

    public function __construct(UserWriteRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(SaveUserCommand $createUserCommand)
    {
        $this->userRepository->save($createUserCommand->user());
    }
}