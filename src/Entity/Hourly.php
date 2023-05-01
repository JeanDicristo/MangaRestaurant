<?php

namespace App\Entity;

use App\Repository\HourlyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HourlyRepository::class)]
class Hourly
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 11)]
    private ?string $day = null;

    #[ORM\Column(length: 255)]
    private ?string $openingTime = null;

    #[ORM\Column(length: 255)]
    private ?string $closedTime = null;

    #[ORM\Column]
    private ?bool $closed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpeningTime(): ?string
    {
        return $this->openingTime;
    }

    public function setOpeningTime(string $openingTime): self
    {
        $this->openingTime = $openingTime;

        return $this;
    }

    public function getClosedTime(): ?string
    {
        return $this->closedTime;
    }

    public function setClosedTime(string $closedTime): self
    {
        $this->closedTime = $closedTime;

        return $this;
    }

    public function isClosed(): ?bool
    {
        return $this->closed;
    }

    public function setClosed(bool $closed): self
    {
        $this->closed = $closed;

        return $this;
    }
}
