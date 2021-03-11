<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\Infrastructure\Entity;

use Eagle\Module\Measurement\Infrastructure\Doctrine\MeasurementRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

/**
 * @ORM\Entity(repositoryClass=MeasurementRepository::class)
 */
class Measurement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $userId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $subjectName;

    /**
     * @ORM\Column(type="integer")
     */
    private int $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeImmutable $measurementTimestamp;

    /**
     * @ORM\Column(type="text")
     */
    private string $payload;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getSubjectName(): ?string
    {
        return $this->subjectName;
    }

    public function setSubjectName(string $subjectName): self
    {
        $this->subjectName = $subjectName;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMeasurementTimestamp(): ?DateTimeImmutable
    {
        return $this->measurementTimestamp;
    }

    public function setMeasurementTimestamp(DateTimeImmutable $measurementTimestamp): self
    {
        $this->measurementTimestamp = $measurementTimestamp;

        return $this;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    public function setPayload(string $payload): self
    {
        $this->payload = $payload;

        return $this;
    }
}
