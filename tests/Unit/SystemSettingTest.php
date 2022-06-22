<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Job;
use HiCo\Message\Key;
use HiCo\Message\SystemSetting;

class SystemSettingTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetAdditionalSettings()
    {
        $setting = ['settings' => true];
        $systemSetting = (new SystemSetting())->setAdditionalSettings($setting);
        $this->assertSame($setting, $systemSetting->getAdditionalSettings());
    }

    public function testSetAndGetQueueUrl()
    {
        $systemSetting = (new SystemSetting())->setQueueUrl('queue-url');
        $this->assertSame('queue-url', $systemSetting->getQueueUrl());
    }

    public function testSetAndGetSystem()
    {
        $systemSetting = (new SystemSetting())->setSystem('system');
        $this->assertSame('system', $systemSetting->getSystem());
    }

    public function testSetAndGetAggregateEvents()
    {
        $systemSetting = (new SystemSetting())->setAggregateEvents(true);
        $this->assertSame(true, $systemSetting->getAggregateEvents());
    }

    public function testSetAndGetPagination()
    {
        $systemSetting = (new SystemSetting())->setPagination(100);
        $this->assertSame(100, $systemSetting->getPagination());
    }

    public function testSetAndGetFunction()
    {
        $systemSetting = (new SystemSetting())->setFunction('function');
        $this->assertSame('function', $systemSetting->getFunction());
    }

    public function testSetAndGetKeyId()
    {
        $systemSetting = (new SystemSetting())->setKey((new Key())->setId('1234'));
        $this->assertSame('1234', $systemSetting->getKey()->getId());
    }

    protected function getDataExample(): array
    {
        return [
            'stream' => [
                Job::STAGE_JOB => [
                    'function' => 'function',
                    'key_id' => 'key-id',
                    'queue_url' => 'queue-url',
                    'system' => 'system',
                    'aggregate_events' => true,
                    'pagination' => 100,
                    'additional_settings' => ['settings' => true],
                ],
            ],
        ];
    }
}
