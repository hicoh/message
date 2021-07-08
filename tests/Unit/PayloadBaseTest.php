<?php

namespace HiCo\Message\Unit;

use HiCo\Message\PayloadBase;

class PayloadBaseTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetPath()
    {
        $payloadBase = (new PayloadBase())->setPath('path');
        $this->assertSame('path', $payloadBase->getPath());
    }

    public function testSetAndGetData()
    {
        $payloadBase = (new PayloadBase())->setData('data');
        $this->assertSame('data', $payloadBase->getData());
    }

    public function testSetAndGetFormat()
    {
        $payloadBase = (new PayloadBase())->setFormat('format');
        $this->assertSame('format', $payloadBase->getFormat());
    }
}
