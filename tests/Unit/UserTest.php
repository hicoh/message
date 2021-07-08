<?php

namespace HiCo\Message\Unit;

use HiCo\Message\User;

class UserTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetAdditionalSettings()
    {
        $settings = ['settings' => true];
        $user = (new User())->setAdditionalSettings($settings);
        $this->assertSame($settings, $user->getAdditionalSettings());
    }
}
