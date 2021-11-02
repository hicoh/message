<?php

namespace HiCo\Message;

class Key
{
    private ?string $id = null;
    private ?string $title = null;
    private ?array $credentials = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCredentials(): ?array
    {
        return $this->credentials;
    }

    public function setCredentials(?array $credentials): self
    {
        $this->credentials = $credentials;

        return $this;
    }

    public function addCredentials(string $key, string $content): self
    {
        $this->credentials[$key] = $content;

        return $this;
    }
}
