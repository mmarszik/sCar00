<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationsRepository")
 */
class Reservations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $date_from;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $date_to;

    /**
     * @ORM\Column(type="boolean")
     */
    private $insurance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\cars", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_car;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->date_from;
    }

    public function setDateFrom(\DateTimeInterface $date_from): self
    {
        $this->date_from = $date_from;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->date_to;
    }

    public function setDateTo(\DateTimeInterface $date_to): self
    {
        $this->date_to = $date_to;

        return $this;
    }

    public function getInsurance(): ?bool
    {
        return $this->insurance;
    }

    public function setInsurance(bool $insurance): self
    {
        $this->insurance = $insurance;

        return $this;
    }

    public function getIdCar(): ?cars
    {
        return $this->id_car;
    }

    public function setIdCar(?cars $id_car): self
    {
        $this->id_car = $id_car;

        return $this;
    }
}
