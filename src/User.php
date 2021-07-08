<?php

namespace HiCo\Message;

class User
{
    private ?array $additionalSettings;

    public function getAdditionalSettings(): ?array
    {
        return $this->additionalSettings;
    }

    public function setAdditionalSettings(?array $additionalSettings): self
    {
        $this->additionalSettings = $additionalSettings;

        return $this;
    }
}
