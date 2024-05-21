<?php

namespace App\Entity;

use App\Repository\CastingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CastingRepository::class)]
class Casting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Film>
     */
    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'acteurs')]
    private Collection $filmsInterpretes;

    /**
     * @var Collection<int, Film>
     */
    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'realisateurs')]
    private Collection $filmsRealises;

    public function __construct()
    {
        $this->filmsInterpretes = new ArrayCollection();
        $this->filmsRealises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilmsInterpretes(): Collection
    {
        return $this->filmsInterpretes;
    }

    public function addFilmsInterprete(Film $filmsInterprete): static
    {
        if (!$this->filmsInterpretes->contains($filmsInterprete)) {
            $this->filmsInterpretes->add($filmsInterprete);
            $filmsInterprete->addActeur($this);
        }

        return $this;
    }

    public function removeFilmsInterprete(Film $filmsInterprete): static
    {
        if ($this->filmsInterpretes->removeElement($filmsInterprete)) {
            $filmsInterprete->removeActeur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilmsRealises(): Collection
    {
        return $this->filmsRealises;
    }

    public function addFilmsRealise(Film $filmsRealise): static
    {
        if (!$this->filmsRealises->contains($filmsRealise)) {
            $this->filmsRealises->add($filmsRealise);
            $filmsRealise->addRealisateur($this);
        }

        return $this;
    }

    public function removeFilmsRealise(Film $filmsRealise): static
    {
        if ($this->filmsRealises->removeElement($filmsRealise)) {
            $filmsRealise->removeRealisateur($this);
        }

        return $this;
    }
}
