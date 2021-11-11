<?php

namespace App\Entity;

use App\Repository\CustomersPicturesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomersPicturesRepository::class)
 */
class CustomersPictures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Dog::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Dog;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sentence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDog(): ?Dog
    {
        return $this->Dog;
    }

    public function setDog(Dog $Dog): self
    {
        $this->Dog = $Dog;

        return $this;
    }

    public function getSentence(): ?string
    {
        return $this->sentence;
    }

    public function setSentence(?string $sentence): self
    {
        $this->sentence = $sentence;

        return $this;
    }
}
