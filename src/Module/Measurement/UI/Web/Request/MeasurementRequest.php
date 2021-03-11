<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\UI\Web\Request;

use DateTime;
use Eagle\Module\Measurement\Domain\Model\Measurement;
use Symfony\Component\Validator\Constraints as Assert;

class MeasurementRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="4", max="100")
     * @var string
     */
    public string $subjectName;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     * @Assert\Choice(callback={"Eagle\Module\Measurement\Domain\Enum\MeasurementType", "toArray"})
     * @var int
     */
    public int $type;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime(message="Timestamp formatted value required")
     * @var string
     */
    public string $timestamp;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public string $payload;

    public static function from(Measurement $measurement): self
    {
        $measurementRequest = new self();
        $measurementRequest->subjectName = $measurement->subjectName();
        $measurementRequest->type = $measurement->type();
        $measurementRequest->timestamp = $measurement->timestamp()->format(DateTime::ATOM);
        $measurementRequest->payload = $measurement->payload();

        return $measurementRequest;
    }
}