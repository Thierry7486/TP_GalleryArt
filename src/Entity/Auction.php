<?php

namespace App\Entity;

use App\Repository\AuctionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuctionRepository::class)
 */
class Auction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $initialPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $biddingLevel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $currentPrice;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="auctions")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="auctions")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=PieceOfArt::class, inversedBy="auctions")
     */
    private $pieceOfArt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitialPrice(): ?int
    {
        return $this->initialPrice;
    }

    public function setInitialPrice(int $initialPrice): self
    {
        $this->initialPrice = $initialPrice;

        return $this;
    }

    public function getBiddingLevel(): ?int
    {
        return $this->biddingLevel;
    }

    public function setBiddingLevel(int $biddingLevel): self
    {
        $this->biddingLevel = $biddingLevel;

        return $this;
    }

    public function getCurrentPrice(): ?int
    {
        return $this->currentPrice;
    }

    public function setCurrentPrice(?int $currentPrice): self
    {
        $this->currentPrice = $currentPrice;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPieceOfArt(): ?PieceOfArt
    {
        return $this->pieceOfArt;
    }

    public function setPieceOfArt(?PieceOfArt $pieceOfArt): self
    {
        $this->pieceOfArt = $pieceOfArt;

        return $this;
    }
}
