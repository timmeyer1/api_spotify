<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SongRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: SongRepository::class)]
#[Vich\Uploadable]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Ajout d'une propriété file
    // #[Vich\UploadableField(mapping: 'songs', fileNameProperty: 'filePath')]
    // private ?File $filePathFile = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $file_path = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\ManyToMany(targetEntity: Playlist::class, mappedBy: 'song')]
    private Collection $playlists;

    #[ORM\ManyToOne(inversedBy: 'songs')]
    private ?Album $album = null;

    public function __construct()
    {
        $this->playlists = new ArrayCollection();
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

    public function getFilePath(): ?string
    {
        return $this->file_path;
    }

    public function setFilePath(string $file_path): static
    {
        $this->file_path = $file_path;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }
    
    public function getFilePathFile(): ?File
    {
        return $this->filePathFile;
    }

    public function setFilePathFile(?File $filePathFile = null): void
    {
        $this->filePathFile = $filePathFile;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): static
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->addSong($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): static
    {
        if ($this->playlists->removeElement($playlist)) {
            $playlist->removeSong($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

        return $this;
    }
}
