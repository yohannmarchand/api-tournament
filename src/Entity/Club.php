<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClubRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 * @ApiResource
 */
class Club
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $api_token;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="club")
     */
    private $player;

    /**
     * @ORM\OneToMany(targetEntity=Tournament::class, mappedBy="club")
     */
    private $tournament;

    public function __construct()
    {
        $this->player = new ArrayCollection();
        $this->tournament = new ArrayCollection();
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getApiToken(): ?string
    {
        return $this->api_token;
    }

    public function setApiToken(?string $api_token): self
    {
        $this->api_token = $api_token;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->player->contains($player)) {
            $this->player[] = $player;
            $player->setClub($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->player->contains($player)) {
            $this->player->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getClub() === $this) {
                $player->setClub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tournament[]
     */
    public function getTournament(): Collection
    {
        return $this->tournament;
    }

    public function addTournament(Tournament $tournament): self
    {
        if (!$this->tournament->contains($tournament)) {
            $this->tournament[] = $tournament;
            $tournament->setClub($this);
        }

        return $this;
    }

    public function removeTournament(Tournament $tournament): self
    {
        if ($this->tournament->contains($tournament)) {
            $this->tournament->removeElement($tournament);
            // set the owning side to null (unless already changed)
            if ($tournament->getClub() === $this) {
                $tournament->setClub(null);
            }
        }

        return $this;
    }
}
