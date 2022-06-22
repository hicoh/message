<?php

namespace HiCo\Message;

class Spec
{
    private string $organisationId;
    private string $dataType;
    private string $id;
    private string $title;
    private string $transformationId;
    private ?string $dedicatedQueueId = null;

    public function getOrganisationId(): string
    {
        return $this->organisationId;
    }

    public function setOrganisationId(string $organisationId): self
    {
        $this->organisationId = $organisationId;

        return $this;
    }

    public function getDataType(): string
    {
        return $this->dataType;
    }

    public function setDataType(string $dataType): self
    {
        $this->dataType = $dataType;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTransformationId(): string
    {
        return $this->transformationId;
    }

    public function setTransformationId(string $transformationId): self
    {
        $this->transformationId = $transformationId;

        return $this;
    }

    public function getDedicatedQueueId(): ?string
    {
        return $this->dedicatedQueueId;
    }

    public function setDedicatedQueueId(?string $dedicatedQueueId): self
    {
        $this->dedicatedQueueId = $dedicatedQueueId;

        return $this;
    }
}
