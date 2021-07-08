<?php

namespace HiCo\Message;

class Job
{
    private const JOB = 'job';
    private const EVENT = 'event';

    public const STAGE_JOB = 'source';
    public const STAGE_EVENT = 'destination';

    public const PENDING_STATUS = 'PENDING';
    public const PROCESSING_STATUS = 'PROCESSING';
    public const FINISHED_STATUS = 'FINISHED';
    public const SOURCE_FINISHED_STATUS = 'SOURCE FINISHED';
    public const FAILED_STATUS = 'FAILED';
    public const FINISHED_WITH_ISSUES_STATUS = 'FINISHED WITH ISSUES';

    private string $id;
    private string $stage;
    private ?Status $status = null;

    public static array $messageDefinition = [
        self::STAGE_JOB => [
            'type' => self::JOB,
        ],
        self::STAGE_EVENT => [
            'type' => self::EVENT,
        ],
    ];

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setStage(string $stage): self
    {
        if (!array_key_exists($stage, self::$messageDefinition)) {
            throw new \Exception('STAGE ' . $stage . ' is not allowed.');
        }
        $this->stage = $stage;

        return $this;
    }

    public function getStage(): string
    {
        return $this->stage;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): self
    {
        $this->status = $status;

        return $this;
    }
}
