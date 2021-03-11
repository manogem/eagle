<?php

namespace Eagle\Tests\Functional;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebTestCaseWithDatabase extends WebTestCase
{
    protected $client;

    protected $em;

    protected $schemaTool;

    protected function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();

        if ('test' !== self::$kernel->getEnvironment()) {
            throw new \LogicException('Tests cases with fresh database must be executed in the test environment');
        }
        $this->em = self::$kernel->getContainer()->get('doctrine')->getManager();

        $this->schemaTool = new SchemaTool($this->em);
    }

    public function addFixture($className)
    {
        $loader = new Loader();
        $loader->addFixture(new $className);

        $purger = new ORMPurger($this->em);
        $executor = new ORMExecutor($this->em, $purger);
        $executor->execute($loader->getFixtures());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $purger = new ORMPurger($this->em);
        $purger->setPurgeMode(2);
        $purger->purge();
    }
}