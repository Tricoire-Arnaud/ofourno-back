<?php

namespace App\Entity;

use App\Entity\Review;
use App\Entity\Category;
use App\Entity\Ustensil;
use App\Entity\Ingredient;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?string $name = null;

    #[ORM\Column(length: 2083, nullable: true)]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?string $picture = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?string $instructions = null;

    #[ORM\Column(length: 30)]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?string $difficulty = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?int $preparationTime = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?int $cookingTime = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?int $servings = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private ?int $rating = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'recipe')]
    #[Groups(['get_recipes_collection', 'get_recipe_item', 'get_recipes_random'])]
    private Collection $categories;

    #[ORM\ManyToMany(targetEntity: Ustensil::class, mappedBy: 'recipe')]
    #[Groups(['get_recipes_collection', 'get_recipe_item'])]
    private Collection $ustensils;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, mappedBy: 'recipe')]
    #[Groups(['get_recipes_collection', 'get_recipe_item'])]
    private Collection $ingredients;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Review::class, orphanRemoval: true)]
    #[Groups(['get_recipe_item'])]
    private Collection $reviews;

    #[ORM\ManyToOne(inversedBy: 'recipe')]
    private ?User $user = null;


    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->ustensils = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
        $this->reviews = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(int $preparationTime): static
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getCookingTime(): ?int
    {
        return $this->cookingTime;
    }

    public function setCookingTime(int $cookingTime): static
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    public function getServings(): ?int
    {
        return $this->servings;
    }

    public function setServings(int $servings): static
    {
        $this->servings = $servings;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addRecipe($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Ustensil>
     */
    public function getUstensils(): Collection
    {
        return $this->ustensils;
    }

    public function addUstensil(Ustensil $ustensil): static
    {
        if (!$this->ustensils->contains($ustensil)) {
            $this->ustensils->add($ustensil);
            $ustensil->addRecipe($this);
        }

        return $this;
    }

    public function removeUstensil(Ustensil $ustensil): static
    {
        if ($this->ustensils->removeElement($ustensil)) {
            $ustensil->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->addRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            $ingredient->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setRecipe($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getRecipe() === $this) {
                $review->setRecipe(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

        /**
     * Calcule la note moyenne de la recette
     *
     * @return float|null
     */
    public function getAverageRating(): ?float
    {
        $totalRatings = count($this->reviews);
        if ($totalRatings === 0) {
            return null;
        }

        $totalSum = 0;
        foreach ($this->reviews as $review) {
            $totalSum += $review->getRating();
        }

        return $totalSum / $totalRatings;
    }

    /**
     * Ajoute une critique à la recette et met à jour la note moyenne
     *
     * @param Review $review
     * @return static
     */
    public function addReviewAndUpdateRating(Review $review): static
    {
        $this->addReview($review);
        $this->updateRating();

        return $this;
    }

    /**
     * Met à jour la note moyenne de la recette
     *
     * @return static
     */
    public function updateRating(): static
    {
        $averageRating = $this->getAverageRating();
        $this->setRating($averageRating);

        return $this;
    }
}
