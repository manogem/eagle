<?php

declare(strict_types=1);

namespace Eagle\Module\User\Application\Command;

use Eagle\Module\User\Domain\Model\User;

class SaveUserCommand
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user(): User
    {
        return $this->user;
    }
}