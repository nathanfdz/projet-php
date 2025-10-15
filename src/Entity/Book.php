<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 13)]
    #[Assert\NotBlank(message: "Le numéro ISBN est obligatoire.")]
    #[Assert\Regex(
        pattern: '/^\d{10}(\d{3})?$/',
        message: "Le numéro ISBN doit contenir 10 ou 13 chiffres."
    )]
    private ?string $isbn = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le titre du livre est obligatoire.")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le titre doit comporter au moins {{ limit }} caractères.",
        maxMessage: "Le titre ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Le résumé ne peut pas être vide.")]
    #[Assert\Length(
        min: 10,
        minMessage: "Le résumé doit comporter au moins {{ limit }} caractères."
    )]
    private ?string $summary = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "L’année de publication est obligatoire.")]
    #[Assert\Range(
        notInRangeMessage: "L’année de publication doit être comprise entre {{ min }} et {{ max }}.",
        min: 1450,
        max: 2100
    )]
    private ?int $publicationYear = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $issueDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotNull(message: "La date de création doit être définie.")]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotNull(message: "La date de mise à jour doit être définie.")]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[Assert\NotNull(message: "Un livre doit être associé à un utilisateur.")]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'books')]
    #[Assert\Count(
        min: 1,
        minMessage: "Un livre doit avoir au moins un genre."
    )]
    private Collection $genres;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'books')]
    #[Assert\Count(
        min: 1,
        minMessage: "Un livre doit avoir au moins un auteur."
    )]
    private Collection $authors;

    #[ORM\OneToOne(mappedBy: 'book', cascade: ['persist', 'remove'])]
    private ?Cover $cover = null;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
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

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getPublicationYear(): ?int
    {
        return $this->publicationYear;
    }

    public function setPublicationYear(int $publicationYear): static
    {
        $this->publicationYear = $publicationYear;

        return $this;
    }

    public function getIssueDate(): ?\DateTimeInterface
    {
        return $this->issueDate;
    }

    public function setIssueDate(?\DateTimeInterface $issueDate): static
    {
        $this->issueDate = $issueDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }

    public function getCover(): ?Cover
    {
        return $this->cover;
    }

    public function setCover(Cover $cover): static
    {
        // set the owning side of the relation if necessary
        if ($cover->getBook() !== $this) {
            $cover->setBook($this);
        }

        $this->cover = $cover;

        return $this;
    }
}
