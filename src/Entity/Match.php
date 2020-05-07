<?php

namespace App\Entity;

use App\Repository\MatchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchRepository::class)
 * @ORM\Table(name="`match`")
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $player_1;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $player_2;

    /**
     * @ORM\Column(type="integer")
     */
    private $point_1;

    /**
     * @ORM\Column(type="integer")
     */
    private $point_2;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer1(): ?string
    {
        return $this->player_1;
    }

    public function setPlayer1(string $player_1): self
    {
        $this->player_1 = $player_1;

        return $this;
    }

    public function getPlayer2(): ?string
    {
        return $this->player_2;
    }

    public function setPlayer2(string $player_2): self
    {
        $this->player_2 = $player_2;

        return $this;
    }

    public function getPoint1(): ?int
    {
        return $this->point_1;
    }

    public function setPoint1(int $point_1): self
    {
        $this->point_1 = $point_1;

        return $this;
    }

    public function getPoint2(): ?int
    {
        return $this->point_2;
    }

    public function setPoint2(int $point_2): self
    {
        $this->point_2 = $point_2;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
