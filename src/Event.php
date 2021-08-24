<?php

namespace HiCo\Message;

class Event
{
    private ?string $id = null;
    private ?array $scheduledEvents = null;
    private ?Status $status = null;
    private ?bool $last = null;
    private int $aggregated = 0;
    private ?string $parent_event_id = null;
    private ?bool $parent_event = null;

    public const OK_STATUS = 'OK';
    public const FAILED_STATUS = 'FAILED';
    public const ERROR_STATUS = 'ERROR';
    public const ABORT_STATUS = 'ABORTED';

    public function __construct($id = null, $scheduledEvents = null, $status = null, $last = null)
    {
        $this->setId($id)
            ->setScheduleEvents($scheduledEvents)
            ->setStatus($status)
            ->setLast($last);
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

    public function getScheduledEvents(): ?array
    {
        return $this->scheduledEvents;
    }

    public function setScheduleEvents(?array $scheduledEvents): self
    {
        if ($scheduledEvents) {
            $collection = [];
            foreach ($scheduledEvents as $scheduledEvent) {
                if ($scheduledEvent instanceof Message) {
                    $collection[] = $scheduledEvent;
                }
            }
            $this->scheduledEvents = $collection;
        } else {
            $this->scheduledEvents = null;
        }

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getLast(): ?bool
    {
        return $this->last;
    }

    public function setLast(?bool $last): self
    {
        $this->last = $last;

        return $this;
    }

    public function getAggregated(): int
    {
        return $this->aggregated;
    }

    public function setAggregated(int $aggregated): self
    {
        $this->aggregated = $aggregated;

        return $this;
    }

    public function getParentEventId(): ?string
    {
        return $this->parent_event_id;
    }

    public function setParentEventId(?string $parent_event_id): self
    {
        $this->parent_event_id = $parent_event_id;

        return $this;
    }

    public function getParentEvent(): ?bool
    {
        return $this->parent_event;
    }

    public function setParentEvent(?bool $parent_event): self
    {
        $this->parent_event = $parent_event;

        return $this;
    }
}
