<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Event;

class EventTest extends \PHPUnit\Framework\TestCase
{
    public function testGetIdReturnsNullIfNotSet()
    {
        $this->assertNull((new Event())->getId());
    }

    public function testSetAndGetId()
    {
        $event = new Event();
        $event->setId('1234');
        $this->assertSame('1234', $event->getId());
    }
}
