<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Event;
use HiCo\Message\Message;
use HiCo\Message\Status;

class EventTest extends \PHPUnit\Framework\TestCase
{
    public function testGetIdReturnsNullIfNotSet()
    {
        $this->assertNull((new Event())->getId());
    }

    public function testGetScheduledEventsReturnsNullIfNotSet()
    {
        $this->assertNull((new Event())->getScheduledEvents());
    }

    public function testGetStatusReturnsNullIfNotSet()
    {
        $this->assertNull((new Event())->getStatus());
    }

    public function testGetLastReturnsNullIfNotSet()
    {
        $this->assertNull((new Event())->getLast());
    }

    public function testSetAndGetId()
    {
        $event = new Event();
        $event->setId('1234');
        $this->assertSame('1234', $event->getId());
    }

    public function testSetScheduleEventsCorrectlySets()
    {
        $message = new Message();
        $event = new Event();
        $event->setScheduleEvents([$message]);
        $this->assertSame([$message], $event->getScheduledEvents());
    }

    public function testSetScheduleEventsWithNullAfterBeingSetWithArraySetsToNull()
    {
        $message = new Message();
        $event = new Event(null, [$message]);
        $event->setScheduleEvents(null);
        $this->assertNull($event->getScheduledEvents());
    }

    public function testSetAndGetStatus()
    {
        $status = new Status();
        $event = new Event();
        $event->setStatus($status);
        $this->assertSame($status, $event->getStatus());
    }

    public function testSetAndGetLast()
    {
        $event = new Event();
        $event->setLast(true);
        $this->assertTrue($event->getLast());
    }
}
