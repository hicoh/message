<?php

namespace HiCo\Message\Unit;

use HiCo\Message\EventEntity;

class EventEntityTest extends \PHPUnit\Framework\TestCase
{
    public function testGetIdReturnsNullIfNotSet()
    {
        $this->assertNull((new EventEntity())->getId());
    }

    public function testGetDestinationIdReturnsNullIfNotSet()
    {
        $this->assertNull((new EventEntity())->getDestinationId());
    }

    public function testGetDestinationParentIdReturnsNullIfNotSet()
    {
        $this->assertNull((new EventEntity())->getDestinationParentId());
    }

    public function testSetAndGetId()
    {
        $eventEntity = new EventEntity();
        $eventEntity->setId('1234');
        $this->assertSame('1234', $eventEntity->getId());
    }

    public function testSetAndGetDestinationId()
    {
        $eventEntity = new EventEntity();
        $eventEntity->setDestinationId('1234');
        $this->assertSame('1234', $eventEntity->getDestinationId());
    }

    public function testSetAndGetDestinationParentId()
    {
        $eventEntity = new EventEntity();
        $eventEntity->setDestinationParentId('1234');
        $this->assertSame('1234', $eventEntity->getDestinationParentId());
    }
}
