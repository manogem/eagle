<?php

declare(strict_types=1);

namespace Eagle\Tests\Functional\Module\Measurement\UI\Web\Controller;

use Eagle\Module\Measurement\Domain\Enum\MeasurementType;
use Eagle\Tests\Functional\AuthenticatedClient;
use Symfony\Component\HttpFoundation\Response;

class MeasurementControllerTest extends AuthenticatedClient
{
    public function testCreate(): void
    {
        $data = array(
            'subjectName' => 'test subject name',
            'type' => MeasurementType::MEASURED_HUMIDITY()->getValue(),
            'timestamp' => '2020-12-06 00:00:00',
            'payload' => 'test payload',
        );

        $this->client = $this->createAuthenticatedClient();

        $this->client->request(
            'POST',
            '/api/measurement',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data)
        );

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }
}