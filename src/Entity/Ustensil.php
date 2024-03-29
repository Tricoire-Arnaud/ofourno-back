<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UstensilRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UstensilRepository::class)]
class Ustensil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_recipes_collection', 'get_ustensils_collection', 'get_recipe_item', 'get_ustensil_item'])]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Groups(['get_recipes_collection', 'get_ustensils_collection', 'get_recipe_item', 'get_ustensil_item'])]
    private ?string $name = null;

    #[ORM\Column(length: 2083, nullable: true)]
    #[Groups(['get_recipes_collection', 'get_ustensils_collection', 'get_recipe_item', 'get_ustensil_item'])]
    private ?string $picture = null;

    #[ORM\ManyToMany(targetEntity: Recipe::class, inversedBy: 'ustensils')]
    private Collection $recipe;

    public function __construct()
    {
        $this->recipe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipe(): Collection
    {
        return $this->recipe;
    }

    public function addRecipe(Recipe $recipe): static
    {
        if (!$this->recipe->contains($recipe)) {
            $this->recipe->add($recipe);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): static
    {
        $this->recipe->removeElement($recipe);

        return $this;
    }
}
