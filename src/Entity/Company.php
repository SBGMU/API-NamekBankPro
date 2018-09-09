<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class Company
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("company")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("company")
     * @Groups("master")
     * @Groups("creditCards")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("company")
     * @Groups("master")
     * @Groups("creditCards")
     */
    private $slogan;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("company")
     * @Groups("master")
     * @Groups("creditCards")
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("company")
     * @Groups("master")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("company")
     */
    private $websiteUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pictureUrl;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Master", inversedBy="company", cascade={"persist", "remove"})
     * @Groups("company")
     * @Groups("creditCards")
     */
    private $master;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CreditCard", mappedBy="company")
     * @Groups("company")
     */
    private $creditCards;

    public function __construct()
    {
        $this->creditCards = new ArrayCollection();
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

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(string $websiteUrl): self
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl(?string $pictureUrl): self
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    public function getMaster(): ?Master
    {
        return $this->master;
    }

    public function setMaster(?Master $master): self
    {
        $this->master = $master;

        return $this;
    }

    /**
     * @return Collection|CreditCard[]
     */
    public function getCreditCards(): Collection
    {
        return $this->creditCards;
    }

    public function addCreditCard(CreditCard $creditCard): self
    {
        if (!$this->creditCards->contains($creditCard)) {
            $this->creditCards[] = $creditCard;
            $creditCard->setCompany($this);
        }

        return $this;
    }

    public function removeCreditCard(CreditCard $creditCard): self
    {
        if ($this->creditCards->contains($creditCard)) {
            $this->creditCards->removeElement($creditCard);
            // set the owning side to null (unless already changed)
            if ($creditCard->getCompany() === $this) {
                $creditCard->setCompany(null);
            }
        }

        return $this;
    }
}
