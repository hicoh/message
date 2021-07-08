<?php

namespace HiCo\Message;

class Payload
{
    private PayloadBase $in;

    private PayloadBase $out;

    private PayloadBase $webHookEvent;

    public function setIn(PayloadBase $in): self
    {
        $this->in = $in;

        return $this;
    }

    public function getIn(): PayloadBase
    {
        return $this->in;
    }

    public function setOut(PayloadBase $out): self
    {
        $this->out = $out;

        return $this;
    }

    public function getOut(): PayloadBase
    {
        return $this->out;
    }

    public function getWebHookEvent(): PayloadBase
    {
        return $this->webHookEvent;
    }

    public function setWebHookEvent(PayloadBase $webHookEvent): self
    {
        $this->webHookEvent = $webHookEvent;

        return $this;
    }
}
