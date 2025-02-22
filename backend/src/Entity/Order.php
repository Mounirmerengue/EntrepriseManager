<?php

namespace App\Entity;

use App\Enum\DeliveryStatus;
use App\Enum\OrderStatus;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: DeliveryStatus::class)]
    private ?DeliveryStatus $delivery_status = null;

    #[ORM\Column(enumType: OrderStatus::class)]
    private ?OrderStatus $order_status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Costumer $client_id = null;

    /**
     * @var Collection<int, OrderLine>
     */
    #[ORM\OneToMany(targetEntity: OrderLine::class, mappedBy: 'order_id')]
    private Collection $orderLines;

    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
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

    public function getDeliveryStatus(): ?DeliveryStatus
    {
        return $this->delivery_status;
    }

    public function setDeliveryStatus(DeliveryStatus $delivery_status): static
    {
        $this->delivery_status = $delivery_status;

        return $this;
    }

    public function getOrderStatus(): ?OrderStatus
    {
        return $this->order_status;
    }

    public function setOrderStatus(OrderStatus $order_status): static
    {
        $this->order_status = $order_status;

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

    public function getClientId(): ?Costumer
    {
        return $this->client_id;
    }

    public function setClientId(?Costumer $client_id): static
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * @return Collection<int, OrderLine>
     */
    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    public function addOrderLine(OrderLine $orderLine): static
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines->add($orderLine);
            $orderLine->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): static
    {
        if ($this->orderLines->removeElement($orderLine)) {
            // set the owning side to null (unless already changed)
            if ($orderLine->getOrderId() === $this) {
                $orderLine->setOrderId(null);
            }
        }

        return $this;
    }
}
