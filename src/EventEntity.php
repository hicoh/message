<?php

namespace HiCo\Message;

class EventEntity
{
    private ?string $id = null;
    private ?string $destinationId = null;
    private ?string $destinationParentId = null;

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDestinationId(): ?string
    {
        return $this->destinationId;
    }

    public function setDestinationId(?string $destinationId): self
    {
        $this->destinationId = $destinationId;

        return $this;
    }

    public function getDestinationParentId(): ?string
    {
        return $this->destinationParentId;
    }

    public function setDestinationParentId(?string $destinationParentId): self
    {
        $this->destinationParentId = $destinationParentId;

        return $this;
    }
}
