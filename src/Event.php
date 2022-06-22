<?php

namespace HiCo\Message;

class Event
{
    private ?string $id = null;
    private ?string $original_event_id = null;

    public const OK_STATUS = 'OK';
    public const TRANSFORMED_STATUS = 'TRANSFORMED';
    public const FAILED_STATUS = 'FAILED';
    public const ERROR_STATUS = 'ERROR';
    public const ABORT_STATUS = 'ABORTED';

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getOriginalEventId(): ?string
    {
        return $this->original_event_id;
    }

    public function setOriginalEventId(?string $original_event_id): self
    {
        $this->original_event_id = $original_event_id;

        return $this;
    }
}
