<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Event;
use HiCo\Message\EventEntity;
use HiCo\Message\Job;
use HiCo\Message\Message;
use HiCo\Message\Payload;
use HiCo\Message\Stream;
use HiCo\Message\SystemSetting;

class MessageTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetStream()
    {
        $stream = new Stream();
        $message = (new Message())->setStream($stream);
        $this->assertSame($stream, $message->getStream());
    }

    public function testSetAndGetJob()
    {
        $job = new Job();
        $message = (new Message())->setJob($job);
        $this->assertSame($job, $message->getJob());
    }

    public function testSetAndGetEvent()
    {
        $event = new Event();
        $message = (new Message())->setEvent($event);
        $this->assertSame($event, $message->getEvent());
    }
}
