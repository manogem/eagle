<?php

declare(strict_types=1);

namespace Eagle\Tests\Functional;

use Eagle\Module\User\Infrastructure\Doctrine\UserRepository;
use Eagle\Module\User\Infrastructure\Entity\User;
use Eagle\Tests\Functional\Module\Measurement\DataFixture\MeasurementFixture;
use Eagle\Tests\Functional\Module\User\DataFixture\UserFixture;

class AuthenticatedClient extends WebTestCaseWithDatabase
{
    public function setUp()
    {
        parent::setUp();

        $this->addFixture(UserFixture::class);
        $this->addFixture(MeasurementFixture::class);
    }

    protected function createAuthenticatedClient($username = 'user@user.com', $password = 'user123')
    {
        $userRepository = $this->em->getRepository(User::class);

        $testUser = $userRepository->findOneByEmail($username);

        // simulate $testUser being logged in
        $this->client->loginUser($testUser);

        return $this->client;
    }
}