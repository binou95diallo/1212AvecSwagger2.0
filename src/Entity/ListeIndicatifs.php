<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListeIndicatifsRepository")
 */
class ListeIndicatifs
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
    private $indicatifs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndicatifs(): ?string
    {
        return $this->indicatifs;
    }

    public function setIndicatifs(string $indicatifs): self
    {
        $this->indicatifs = $indicatifs;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }
}
