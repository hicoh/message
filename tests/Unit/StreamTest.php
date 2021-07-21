<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Spec;
use HiCo\Message\Stream;
use HiCo\Message\SystemSetting;
use HiCo\Message\User;

class StreamTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetDestination()
    {
        $setting = new SystemSetting();
        $stream = (new Stream())->setDestination($setting);
        $this->assertSame($setting, $stream->getDestination());
    }

    public function testSetAndGetSource()
    {
        $setting = new SystemSetting();
        $stream = (new Stream())->setSource($setting);
        $this->assertSame($setting, $stream->getSource());
    }

    public function testSetAndGetSpec()
    {
        $spec = new Spec();
        $stream = (new Stream())->setSpec($spec);
        $this->assertSame($spec, $stream->getSpec());
    }

    public function testSetAndGetUser()
    {
        $user = new User();
        $stream = (new Stream())->setUser($user);
        $this->assertSame($user, $stream->getUser());
    }
}
