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

    public function testSetAndGetAggregated()
    {
        $event = new Event();
        $event->setAggregated(0);
        $this->assertSame(0, $event->getAggregated());
    }

    public function testNoSetAndGetAggregated()
    {
        $event = new Event();
        $this->assertSame(0, $event->getAggregated());
    }

    public function testSetAndGetParentEvent()
    {
        $event = new Event();
        $event->setParentEvent(true);
        $this->assertSame(true, $event->getParentEvent());
    }

    public function testNoSetAndGetParentEvent()
    {
        $event = new Event();
        $this->assertSame(null, $event->getParentEvent());
    }

    public function testSetAndGetParentEventId()
    {
        $event = new Event();
        $event->setParentEventId('12345');
        $this->assertSame('12345', $event->getParentEventId());
    }

    public function testNoSetAndGetAggregatedId()
    {
        $event = new Event();
        $this->assertSame(null, $event->getParentEventId());
    }

    public function testSetNullOriginalEventId()
    {
        $event = new Event();
        $this->assertSame(null, $event->getOriginalEventId());
    }

    public function testSetNullDuplicatedEventIdList()
    {
        $event = new Event();
        $this->assertSame(null, $event->getDuplicatedEventIdList());
    }

    public function testAddDuplicatedEventId()
    {
        $event = (new Event())->addDuplicatedEventIdList('123');
        $this->assertSame('123', $event->getDuplicatedEventIdList()[0]);

    }
}
