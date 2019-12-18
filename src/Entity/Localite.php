<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocaliteRepository")
 */
class Localite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entreprise", mappedBy="localite")
     */
    private $entreprises;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeLocalite", inversedBy="localites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_localite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Agence", mappedBy="localite")
     */
    private $agences;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localite", inversedBy="localites")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Localite", mappedBy="parent")
     */
    private $localites;

    public function __construct()
    {
        $this->entreprises = new ArrayCollection();
        $this->agences = new ArrayCollection();
        $this->localites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Entreprise[]
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises[] = $entreprise;
            $entreprise->setLocalite($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprises->contains($entreprise)) {
            $this->entreprises->removeElement($entreprise);
            // set the owning side to null (unless already changed)
            if ($entreprise->getLocalite() === $this) {
                $entreprise->setLocalite(null);
            }
        }

        return $this;
    }


    /**
     * Get the value of type_localite
     */ 
    public function getTypeLocalite()
    {
        return $this->type_localite;
    }

    /**
     * Set the value of type_localite
     *
     * @return  self
     */ 
    public function setTypeLocalite($type_localite)
    {
        $this->type_localite = $type_localite;

        return $this;
    }

    /**
     * @return Collection|Agence[]
     */
    public function getAgences(): Collection
    {
        return $this->agences;
    }

    public function addAgence(Agence $agence): self
    {
        if (!$this->agences->contains($agence)) {
            $this->agences[] = $agence;
            $agence->setLocalite($this);
        }

        return $this;
    }

    public function removeAgence(Agence $agence): self
    {
        if ($this->agences->contains($agence)) {
            $this->agences->removeElement($agence);
            // set the owning side to null (unless already changed)
            if ($agence->getLocalite() === $this) {
                $agence->setLocalite(null);
            }
        }

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getLocalites(): Collection
    {
        return $this->localites;
    }

    public function addLocalite(self $localite): self
    {
        if (!$this->localites->contains($localite)) {
            $this->localites[] = $localite;
            $localite->setParent($this);
        }

        return $this;
    }

    public function removeLocalite(self $localite): self
    {
        if ($this->localites->contains($localite)) {
            $this->localites->removeElement($localite);
            // set the owning side to null (unless already changed)
            if ($localite->getParent() === $this) {
                $localite->setParent(null);
            }
        }

        return $this;
    }
}
