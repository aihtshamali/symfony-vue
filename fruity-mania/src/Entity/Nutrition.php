<?php

namespace App\Entity;

use App\Repository\NutritionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NutritionRepository::class)]
class Nutrition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'nutritions', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fruit $fruit = null;

    #[ORM\Column]
    private ?int $carbohydrates = null;

    #[ORM\Column]
    private ?int $protein = null;

    #[ORM\Column]
    private ?int $fat = null;

    #[ORM\Column]
    private ?int $calories = null;

    #[ORM\Column]
    private ?int $sugar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFruit(): ?Fruit
    {
        return $this->fruit;
    }

    public function setFruit(Fruit $fruit): self
    {
        $this->fruit = $fruit;

        return $this;
    }

    public function getCarbohydrates(): ?int
    {
        return $this->carbohydrates;
    }

    public function setCarbohydrates(int $carbohydrates): self
    {
        $this->carbohydrates = $carbohydrates;

        return $this;
    }

    public function getProtein(): ?int
    {
        return $this->protein;
    }

    public function setProtein(int $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getFat(): ?int
    {
        return $this->fat;
    }

    public function setFat(int $fat): self
    {
        $this->fat = $fat;

        return $this;
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getSugar(): ?int
    {
        return $this->sugar;
    }

    public function setSugar(int $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }
}
