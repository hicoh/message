<?php

namespace HiCo\Message;

class SystemSetting
{
    private ?string $function = null;
    private ?Key $key = null;
    private ?string $options = null;
    private ?string $queueUrl = null;
    private ?string $system = null;
    private ?string $trigger = null;
    private ?bool $aggregate_events = null;
    private ?int $pagination = null;
    private ?string $url = null;
    private ?array $additionalSettings = null;

    public function getAdditionalSettings(): ?array
    {
        return $this->additionalSettings;
    }

    public function setAdditionalSettings(?array $additionalSettings): self
    {
        $this->additionalSettings = $additionalSettings;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(?string $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getQueueUrl(): ?string
    {
        return $this->queueUrl;
    }

    public function setQueueUrl(?string $queueUrl): self
    {
        $this->queueUrl = $queueUrl;

        return $this;
    }

    public function getSystem(): ?string
    {
        return $this->system;
    }

    public function setSystem(?string $system): self
    {
        $this->system = $system;

        return $this;
    }

    public function getTrigger(): ?string
    {
        return $this->trigger;
    }

    public function setTrigger(?string $trigger): self
    {
        $this->trigger = $trigger;

        return $this;
    }

    public function getAggregateEvents(): ?bool
    {
        return $this->aggregate_events;
    }

    public function setAggregateEvents(?bool $aggregate_events): self
    {
        $this->aggregate_events = $aggregate_events;

        return $this;
    }

    public function getPagination(): ?int
    {
        return $this->pagination;
    }

    public function setPagination(?int $pagination): self
    {
        $this->pagination = $pagination;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getFunction(): ?string
    {
        return $this->function;
    }

    public function setFunction(?string $function): self
    {
        $this->function = $function;

        return $this;
    }

    public function getKey(): ?Key
    {
        return $this->key;
    }

    public function setKey(?Key $key): self
    {
        $this->key = $key;

        return $this;
    }
}
