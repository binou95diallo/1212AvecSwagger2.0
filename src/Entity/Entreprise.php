<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;
       /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fixe;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site_web;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $boite_postal;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $quartier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rue;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Agence", mappedBy="entreprise")
     */
    private $agences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ParcFixe", mappedBy="entreprise")
     */
    private $parc_fixe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localite", inversedBy="entreprises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Domaine", inversedBy="entreprises")
     */
    private $domaine;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Horaires", inversedBy="entreprise", cascade={"persist", "remove"})
     */
    private $horaire;

    public function __construct()
    {
        $this->agences = new ArrayCollection();
        $this->parc_fixe = new ArrayCollection();
        $this->domaine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }


    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->site_web;
    }

    public function setSiteWeb(?string $site_web): self
    {
        $this->site_web = $site_web;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getBoitePostale(): ?string
    {
        return $this->boite_postal;
    }

    public function setBoitePostale(?string $boite_postal): self
    {
        $this->boite_postal = $boite_postal;

        return $this;
    }

    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    public function setQuartier(?string $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

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
            $agence->setEntreprise($this);
        }

        return $this;
    }

    public function removeAgence(Agence $agence): self
    {
        if ($this->agences->contains($agence)) {
            $this->agences->removeElement($agence);
            // set the owning side to null (unless already changed)
            if ($agence->getEntreprise() === $this) {
                $agence->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of fixe
     */ 
    public function getFixe()
    {
        return $this->fixe;
    }

    /**
     * Set the value of fixe
     *
     * @return  self
     */ 
    public function setFixe($fixe)
    {
        $this->fixe = $fixe;

        return $this;
    }

    /**
     * @return Collection|ParcFixe[]
     */
    public function getParcFixe(): Collection
    {
        return $this->parc_fixe;
    }

    public function addParcFixe(ParcFixe $parcFixe): self
    {
        if (!$this->parc_fixe->contains($parcFixe)) {
            $this->parc_fixe[] = $parcFixe;
            $parcFixe->setEntreprise($this);
        }

        return $this;
    }

    public function removeParcFixe(ParcFixe $parcFixe): self
    {
        if ($this->parc_fixe->contains($parcFixe)) {
            $this->parc_fixe->removeElement($parcFixe);
            // set the owning side to null (unless already changed)
            if ($parcFixe->getEntreprise() === $this) {
                $parcFixe->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getLocalite(): ?Localite
    {
        return $this->localite;
    }

    public function setLocalite(?Localite $localite): self
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * @return Collection|Domaine[]
     */
    public function getDomaine(): Collection
    {
        return $this->domaine;
    }

    public function addDomaine(Domaine $domaine): self
    {
        if (!$this->domaine->contains($domaine)) {
            $this->domaine[] = $domaine;
        }

        return $this;
    }

    public function removeDomaine(Domaine $domaine): self
    {
        if ($this->domaine->contains($domaine)) {
            $this->domaine->removeElement($domaine);
        }

        return $this;
    }

    public function getHoraire(): ?Horaires
    {
        return $this->horaire;
    }

    public function setHoraire(?Horaires $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

}
