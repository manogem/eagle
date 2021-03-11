<?php

declare(strict_types=1);

namespace Eagle\Tests\Functional\Module\User\DataFixture;

use Eagle\Module\User\Infrastructure\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user@user.com');
        $user->setUsername('user@user.com');
        $user->setPassword('user123');

        $manager->persist($user);
        $manager->flush();
    }
}