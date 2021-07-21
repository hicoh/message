<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Payload;
use HiCo\Message\PayloadBase;

class PayloadTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetIn()
    {
        $payloadBase = new PayloadBase();
        $payload = (new Payload())->setIn($payloadBase);
        $this->assertSame($payloadBase, $payload->getIn());
    }

    public function testSetAndGetOut()
    {
        $payloadBase = new PayloadBase();
        $payload = (new Payload())->setOut($payloadBase);
        $this->assertSame($payloadBase, $payload->getOut());
    }

    public function testSetAndGetWebhookEvent()
    {
        $payloadBase = new PayloadBase();
        $payload = (new Payload())->setWebHookEvent($payloadBase);
        $this->assertSame($payloadBase, $payload->getWebHookEvent());
    }
}
