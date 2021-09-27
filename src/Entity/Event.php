<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="events")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=PieceOfArt::class, inversedBy="events")
     */
    private $pieceOfArt;

    /**
     * @ORM\OneToMany(targetEntity=Auction::class, mappedBy="event")
     */
    private $auctions;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->pieceOfArt = new ArrayCollection();
        $this->auctions = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

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
        }

        return $this;
    }

    public function removePieceOfArt(PieceOfArt $pieceOfArt): self
    {
        $this->pieceOfArt->removeElement($pieceOfArt);

        return $this;
    }

    /**
     * @return Collection|Auction[]
     */
    public function getAuctions(): Collection
    {
        return $this->auctions;
    }

    public function addAuction(Auction $auction): self
    {
        if (!$this->auctions->contains($auction)) {
            $this->auctions[] = $auction;
            $auction->setEvent($this);
        }

        return $this;
    }

    public function removeAuction(Auction $auction): self
    {
        if ($this->auctions->removeElement($auction)) {
            // set the owning side to null (unless already changed)
            if ($auction->getEvent() === $this) {
                $auction->setEvent(null);
            }
        }

        return $this;
    }
}
