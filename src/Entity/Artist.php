<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $nationality;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=PieceOfArt::class, mappedBy="artist")
     */
    private $pieceOfArt;

    public function __construct()
    {
        $this->pieceOfArt = new ArrayCollection();
    }

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|PieceOfArt[]
     */
    public function getPieceOfArt(): Collection
    {
        return $this->pieceOfArt;
    }

    public function addPieceOfArt(PieceOfArt $pieceOfArt): self
    {
        if (!$this->pieceOfArt->contains($pieceOfArt)) {
            $this->pieceOfArt[] = $pieceOfArt;
            $pieceOfArt->setArtist($this);
        }

        return $this;
    }

    public function removePieceOfArt(PieceOfArt $pieceOfArt): self
    {
        if ($this->pieceOfArt->removeElement($pieceOfArt)) {
            // set the owning side to null (unless already changed)
            if ($pieceOfArt->getArtist() === $this) {
                $pieceOfArt->setArtist(null);
            }
        }

        return $this;
    }
}
