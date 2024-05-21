<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $annee = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $synopsis = null;

    /**
     * @var Collection<int, Genre>
     */
    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'films')]
    private Collection $genres;

    /**
     * @var Collection<int, Pays>
     */
    #[ORM\ManyToMany(targetEntity: Pays::class, inversedBy: 'films')]
    private Collection $pays;

    /**
     * @var Collection<int, Casting>
     */
    #[ORM\ManyToMany(targetEntity: Casting::class, inversedBy: 'filmsInterpretes')]
    #[ORM\JoinTable('acteur_film')]
    private Collection $acteurs;

    /**
     * @var Collection<int, Casting>
     */
    #[ORM\ManyToMany(targetEntity: Casting::class, inversedBy: 'filmsRealises')]
    #[ORM\JoinTable('real_film')]
    private Collection $realisateurs;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->pays = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, Pays>
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): static
    {
        if (!$this->pays->contains($pay)) {
            $this->pays->add($pay);
        }

        return $this;
    }

    public function removePay(Pays $pay): static
    {
        $this->pays->removeElement($pay);

        return $this;
    }

    /**
     * @return Collection<int, Casting>
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Casting $acteur): static
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs->add($acteur);
        }

        return $this;
    }

    public function removeActeur(Casting $acteur): static
    {
        $this->acteurs->removeElement($acteur);

        return $this;
    }

    /**
     * @return Collection<int, Casting>
     */
    public function getRealisateurs(): Collection
    {
        return $this->realisateurs;
    }

    public function addRealisateur(Casting $realisateur): static
    {
        if (!$this->realisateurs->contains($realisateur)) {
            $this->realisateurs->add($realisateur);
        }

        return $this;
    }

    public function removeRealisateur(Casting $realisateur): static
    {
        $this->realisateurs->removeElement($realisateur);

        return $this;
    }
}
