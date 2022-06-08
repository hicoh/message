<?php

namespace HiCo\Message;

class Message
{
    private Stream $stream;
    private Job $job;
    private ?Event $event = null;

    public function setStream(Stream $stream): self
    {
        $this->stream = $stream;

        return $this;
    }

    public function getStream(): Stream
    {
        return $this->stream;
    }

    public function setJob(Job $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getJob(): Job
    {
        return $this->job;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function getStageSystemSetting(): SystemSetting
    {
        return (self::getStream())->{'get' . ucfirst($this->getJob()->getStage())}();
    }
}
