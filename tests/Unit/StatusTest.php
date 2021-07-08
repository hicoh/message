<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Status;

class StatusTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetStatus()
    {
        $status = (new Status())->setStatus('status');
        $this->assertSame('status', $status->getStatus());
    }
    public function testSetAndGetMessage()
    {
        $status = (new Status())->setMessage('message');
        $this->assertSame('message', $status->getMessage());
    }
    public function testSetAndGetDid()
    {
        $status = (new Status())->setDId('did');
        $this->assertSame('did', $status->getDId());
    }
    public function testSetAndGetDPid()
    {
        $status = (new Status())->setDPid('dpid');
        $this->assertSame('dpid', $status->getDPid());
    }
    public function testSetAndGetFlag()
    {
        $status = (new Status())->setFlag('flag');
        $this->assertSame('flag', $status->getFlag());
    }
}
