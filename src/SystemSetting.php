<?php

namespace HiCo\Message;

class SystemSetting
{
    private ?string $function;
    private ?string $keyId;
    private ?string $options;
    private ?string $queueUrl;
    private ?string $system;
    private ?string $trigger;
    private ?string $url;
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

    public function getKeyId(): ?string
    {
        return $this->keyId;
    }

    public function setKeyId(?string $keyId): self
    {
        $this->keyId = $keyId;

        return $this;
    }

    public function setSystemSettings(?array $data, string $systemDestination): ?self
    {
        if (isset($data['stream'][$systemDestination]['function'])) {
            $this->setFunction($data['stream'][$systemDestination]['function']);
        }
        if (isset($data['stream'][$systemDestination]['key_id'])) {
            $this->setKeyId($data['stream'][$systemDestination]['key_id']);
        }
        if (isset($data['stream'][$systemDestination]['options'])) {
            $this->setOptions($data['stream'][$systemDestination]['options']);
        }
        if (isset($data['stream'][$systemDestination]['queue_url'])) {
            $this->setQueueUrl($data['stream'][$systemDestination]['queue_url']);
        }
        if (isset($data['stream'][$systemDestination]['system'])) {
            $this->setSystem($data['stream'][$systemDestination]['system']);
        }
        if (isset($data['stream'][$systemDestination]['trigger'])) {
            $this->setTrigger($data['stream'][$systemDestination]['trigger']);
        }
        if (isset($data['stream'][$systemDestination]['url'])) {
            $this->setUrl($data['stream'][$systemDestination]['url']);
        }
        if (
            isset($data['stream'][$systemDestination]['additional_settings']) &&
            is_array($data['stream'][$systemDestination]['additional_settings'])
        ) {
            $this->setAdditionalSettings($data['stream'][$systemDestination]['additional_settings']);
        }

        return $this;
    }
}
