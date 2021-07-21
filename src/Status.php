<?php

namespace HiCo\Message;

class Status
{
    private ?string $status = null;
    private ?string $message = null;
    private ?string $dId = null;
    private ?string $dPid = null;
    private ?string $flag = null;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDId(): ?string
    {
        return $this->dId;
    }

    public function setDId(?string $dId): self
    {
        $this->dId = $dId;

        return $this;
    }

    public function getDPid(): ?string
    {
        return $this->dPid;
    }

    public function setDPid(?string $dPid): self
    {
        $this->dPid = $dPid;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(?string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }
}
