<?php

namespace HiCo\Message;

class Stream
{
    private SystemSetting $destination;
    private SystemSetting $source;
    private Spec $spec;
    private ?User $user = null;

    public function setDestination(SystemSetting $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): SystemSetting
    {
        return $this->destination;
    }

    public function setSource(SystemSetting $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getSource(): SystemSetting
    {
        return $this->source;
    }

    public function setSpec(Spec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function getSpec(): Spec
    {
        return $this->spec;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
