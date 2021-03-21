<?php

namespace App\Entity;

use App\Repository\PriceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=PriceRepository::class)
 * @UniqueEntity(
 * fields= {"race"},
 * message="Cette race a déjà été rentrée ! ")
 */
class Price
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $race;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tonte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coupe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $epilation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getTonte(): ?string
    {
        return $this->tonte;
    }

    public function setTonte(string $tonte): self
    {
        $this->tonte = $tonte;

        return $this;
    }

    public function getCoupe(): ?string
    {
        return $this->coupe;
    }

    public function setCoupe(string $coupe): self
    {
        $this->coupe = $coupe;

        return $this;
    }

    public function getEpilation(): ?string
    {
        return $this->epilation;
    }

    public function setEpilation(string $epilation): self
    {
        $this->epilation = $epilation;

        return $this;
    }

    public function getBain(): ?string
    {
        return $this->bain;
    }

    public function setBain(string $bain): self
    {
        $this->bain = $bain;

        return $this;
    }
}
