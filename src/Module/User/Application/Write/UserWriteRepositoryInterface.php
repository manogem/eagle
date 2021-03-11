<?php

declare(strict_types=1);

namespace Eagle\Module\User\Application\Write;

use Eagle\Module\User\Domain\Model\User;

interface UserWriteRepositoryInterface
{
    public function save(User $user): void;
}