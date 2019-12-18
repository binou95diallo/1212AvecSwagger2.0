<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HorairesRepository")
 */
class Horaires
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lundi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mardi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mercredi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jeudi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vendredi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $samedi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dimanche;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Entreprise", mappedBy="horaire", cascade={"persist", "remove"})
     */
    private $entreprise;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLundi(): ?string
    {
        return $this->lundi;
    }

    public function setLundi(?string $lundi): self
    {
        $this->lundi = $lundi;

        return $this;
    }

    public function getMardi(): ?string
    {
        return $this->mardi;
    }

    public function setMardi(?string $mardi): self
    {
        $this->mardi = $mardi;

        return $this;
    }

    public function getMercredi(): ?string
    {
        return $this->mercredi;
    }

    public function setMercredi(string $mercredi): self
    {
        $this->mercredi = $mercredi;

        return $this;
    }

    public function getJeudi(): ?string
    {
        return $this->jeudi;
    }

    public function setJeudi(?string $jeudi): self
    {
        $this->jeudi = $jeudi;

        return $this;
    }

    public function getVendredi(): ?string
    {
        return $this->vendredi;
    }

    public function setVendredi(?string $vendredi): self
    {
        $this->vendredi = $vendredi;

        return $this;
    }

    public function getSamedi(): ?string
    {
        return $this->samedi;
    }

    public function setSamedi(?string $samedi): self
    {
        $this->samedi = $samedi;

        return $this;
    }

    public function getDimanche(): ?string
    {
        return $this->dimanche;
    }

    public function setDimanche(?string $dimanche): self
    {
        $this->dimanche = $dimanche;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        // set (or unset) the owning side of the relation if necessary
        $newHoraire = null === $entreprise ? null : $this;
        if ($entreprise->getHoraire() !== $newHoraire) {
            $entreprise->setHoraire($newHoraire);
        }

        return $this;
    }

   
}
