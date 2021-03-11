<?php

declare(strict_types=1);

namespace Eagle\Tests\Unit\Module\User;

use Eagle\Module\User\Domain\Model\User;
use Eagle\Module\User\UI\Web\Request\UserRequest;

class TestObjectMother
{
    public static function userModel(): User
    {
        return new User(
            'username',
            'user@email.com',
            'password',
            ['ROLE_USER']
        );
    }

    public static function userRequest(): UserRequest
    {
        $userRequest = new UserRequest();
        $userRequest->username = 'username';
        $userRequest->email = 'user@email.com';
        $userRequest->password = 'password';
        $userRequest->isActive = true;

        return $userRequest;
    }
}