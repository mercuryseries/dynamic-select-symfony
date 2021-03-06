<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 * @ORM\Table(name="tickets")
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please enter your name")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Seems like your issue has been resolved :).")
     * @Assert\Length(min=5)
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="You need to select your country")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="You need to select your city")
     */
    private $city;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
