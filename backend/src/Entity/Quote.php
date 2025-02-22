<?php

namespace App\Entity;

use App\Enum\QuoteStatus;
use App\Repository\QuoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuoteRepository::class)]
class Quote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'quotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Costumer $client_id = null;

    #[ORM\Column]
    private ?int $quote_number = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $quote_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $validity_date = null;

    #[ORM\Column(enumType: QuoteStatus::class)]
    private ?QuoteStatus $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    /**
     * @var Collection<int, QuoteLine>
     */
    #[ORM\OneToMany(targetEntity: QuoteLine::class, mappedBy: 'quote_id')]
    private Collection $quoteLines;

    public function __construct()
    {
        $this->quoteLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getClientId(): ?Costumer
    {
        return $this->client_id;
    }

    public function setClientId(?Costumer $client_id): static
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getQuoteNumber(): ?int
    {
        return $this->quote_number;
    }

    public function setQuoteNumber(int $quote_number): static
    {
        $this->quote_number = $quote_number;

        return $this;
    }

    public function getQuoteDate(): ?\DateTimeInterface
    {
        return $this->quote_date;
    }

    public function setQuoteDate(\DateTimeInterface $quote_date): static
    {
        $this->quote_date = $quote_date;

        return $this;
    }

    public function getValidityDate(): ?\DateTimeInterface
    {
        return $this->validity_date;
    }

    public function setValidityDate(\DateTimeInterface $validity_date): static
    {
        $this->validity_date = $validity_date;

        return $this;
    }

    public function getStatus(): ?QuoteStatus
    {
        return $this->status;
    }

    public function setStatus(QuoteStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, QuoteLine>
     */
    public function getQuoteLines(): Collection
    {
        return $this->quoteLines;
    }

    public function addQuoteLine(QuoteLine $quoteLine): static
    {
        if (!$this->quoteLines->contains($quoteLine)) {
            $this->quoteLines->add($quoteLine);
            $quoteLine->setQuoteId($this);
        }

        return $this;
    }

    public function removeQuoteLine(QuoteLine $quoteLine): static
    {
        if ($this->quoteLines->removeElement($quoteLine)) {
            // set the owning side to null (unless already changed)
            if ($quoteLine->getQuoteId() === $this) {
                $quoteLine->setQuoteId(null);
            }
        }

        return $this;
    }
}
