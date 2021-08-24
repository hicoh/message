<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Job;
use HiCo\Message\SystemSetting;

class SystemSettingTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetAdditionalSettings()
    {
        $setting = ['settings' => true];
        $systemSetting = (new SystemSetting())->setAdditionalSettings($setting);
        $this->assertSame($setting, $systemSetting->getAdditionalSettings());
    }

    public function testSetAndGetOptions()
    {
        $systemSetting = (new SystemSetting())->setOptions('options');
        $this->assertSame('options', $systemSetting->getOptions());
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

    public function testSetAndGetTrigger()
    {
        $systemSetting = (new SystemSetting())->setTrigger('trigger');
        $this->assertSame('trigger', $systemSetting->getTrigger());
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

    public function testSetAndGetUrl()
    {
        $systemSetting = (new SystemSetting())->setUrl('url');
        $this->assertSame('url', $systemSetting->getUrl());
    }

    public function testSetAndGetFunction()
    {
        $systemSetting = (new SystemSetting())->setFunction('function');
        $this->assertSame('function', $systemSetting->getFunction());
    }

    public function testSetAndGetKeyId()
    {
        $systemSetting = (new SystemSetting())->setKeyId('key-id');
        $this->assertSame('key-id', $systemSetting->getKeyId());
    }

    public function testSetSystemSettingsCorrectlySetsAllSettings()
    {
        $systemSetting = (new SystemSetting())->setSystemSettings(
            $this->getDataExample(),
            Job::STAGE_JOB
        );
        $this->assertSame('function', $systemSetting->getFunction());
        $this->assertSame('key-id', $systemSetting->getKeyId());
        $this->assertSame('options', $systemSetting->getOptions());
        $this->assertSame('queue-url', $systemSetting->getQueueUrl());
        $this->assertSame('system', $systemSetting->getSystem());
        $this->assertSame('trigger', $systemSetting->getTrigger());
        $this->assertSame(true, $systemSetting->getAggregateEvents());
        $this->assertSame(100, $systemSetting->getPagination());
        $this->assertSame('url', $systemSetting->getUrl());
        $this->assertSame(['settings' => true], $systemSetting->getAdditionalSettings());
    }

    protected function getDataExample(): array
    {
        return [
            'stream' => [
                Job::STAGE_JOB => [
                    'function' => 'function',
                    'key_id' => 'key-id',
                    'options' => 'options',
                    'queue_url' => 'queue-url',
                    'system' => 'system',
                    'trigger' => 'trigger',
                    'aggregate_events' => true,
                    'pagination' => 100,
                    'url' => 'url',
                    'additional_settings' => ['settings' => true]
                ]
            ]
        ];
    }
}
