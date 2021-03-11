<?php

declare(strict_types=1);

namespace Eagle\Tests\Functional\Module\Measurement\DataFixture;

use Eagle\Module\Measurement\Domain\Enum\MeasurementType;
use Eagle\Module\Measurement\Infrastructure\Entity\Measurement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;

class MeasurementFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $measurement = new Measurement();
        $measurement->setUserId(1);
        $measurement->setSubjectName('test subject name');
        $measurement->setType(MeasurementType::MEASURED_HUMIDITY()->getValue());
        $measurement->setTimestamp(new \DateTimeImmutable('2020-12-06 00:00:00'));
        $measurement->setPayload('test payload');

        $manager->persist($measurement);
        $manager->flush();
    }
}