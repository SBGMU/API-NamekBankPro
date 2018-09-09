<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CreditCardRepository")
 */
class CreditCard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("creditCards")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("creditCards")
     * @Groups("company")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("creditCards")
     * @Groups("company")
     */
    private $creditCardType;

    /**
     * @ORM\Column(type="bigint")
     * @Groups("creditCards")
     * @Groups("company")
     */
    private $creditCardNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="creditCards")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("creditCards")
     */
    private $company;

    public function __construct()
    {
        
    }

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

    public function getCreditCardType(): ?string
    {
        return $this->creditCardType;
    }

    public function setCreditCardType(string $creditCardType): self
    {
        $this->creditCardType = $creditCardType;

        return $this;
    }

    public function getCreditCardNumber(): ?int
    {
        return $this->creditCardNumber;
    }

    public function setCreditCardNumber(int $creditCardNumber): self
    {
        $this->creditCardNumber = $creditCardNumber;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
