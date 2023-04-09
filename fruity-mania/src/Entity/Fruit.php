<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $genus = null;

    #[ORM\Column(length: 255)]
    private ?string $family = null;

    #[ORM\Column(length: 255)]
    private ?string $fruit_order = null;

    #[ORM\OneToOne(mappedBy: 'fruit', cascade: ['persist', 'remove'])]
    private ?Nutrition $nutritions = null;

    #[ORM\Column]
    private ?int $web_id = null;

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

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(string $genus): self
    {
        $this->genus = $genus;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getFruitOrder(): ?string
    {
        return $this->fruit_order;
    }

    public function setFruitOrder(string $fruit_order): self
    {
        $this->fruit_order = $fruit_order;

        return $this;
    }

    public function getNutritions(): ?Nutrition
    {
        return $this->nutritions;
    }

    public function setNutritions(Nutrition $nutritions): self
    {
        // set the owning side of the relation if necessary
        if ($nutritions->getFruit() !== $this) {
            $nutritions->setFruit($this);
        }

        $this->nutritions = $nutritions;

        return $this;
    }

    public function getWebId(): ?int
    {
        return $this->web_id;
    }

    public function setWebId(int $web_id): self
    {
        $this->web_id = $web_id;

        return $this;
    }
}
