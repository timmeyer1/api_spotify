<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: Song::class, inversedBy: 'playlists')]
    private Collection $song;

    public function __construct()
    {
        $this->song = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Song>
     */
    public function getSong(): Collection
    {
        return $this->song;
    }

    public function addSong(Song $song): static
    {
        if (!$this->song->contains($song)) {
            $this->song->add($song);
        }

        return $this;
    }

    public function removeSong(Song $song): static
    {
        $this->song->removeElement($song);

        return $this;
    }
}
