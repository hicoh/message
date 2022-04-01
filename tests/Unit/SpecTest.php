<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Spec;

class SpecTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetId()
    {
        $spec = (new Spec())->setId('1234-id');
        $this->assertSame('1234-id', $spec->getId());
    }

    public function testSetAndGetOrganisationId()
    {
        $spec = (new Spec())->setOrganisationId('1234-organisation-id');
        $this->assertSame('1234-organisation-id', $spec->getOrganisationId());
    }

    public function testSetAndGetDataType()
    {
        $spec = (new Spec())->setDataType('data_type');
        $this->assertSame('data_type', $spec->getDataType());
    }

    public function testSetAndGetTitle()
    {
        $spec = (new Spec())->setTitle('title');
        $this->assertSame('title', $spec->getTitle());
    }

    public function testSetAndGetTransformationId()
    {
        $spec = (new Spec())->setTransformationId('transformation-id');
        $this->assertSame('transformation-id', $spec->getTransformationId());
    }

    public function testSetAndGetTransformationVersion()
    {
        $spec = (new Spec())->setTransformationVersion('transformation-version');
        $this->assertSame('transformation-version', $spec->getTransformationVersion());
    }

    public function testSetAndGetDedicatedQueueId()
    {
        $spec = (new Spec())->setDedicatedQueueId('dedicated-queue-id');
        $this->assertSame('dedicated-queue-id', $spec->getDedicatedQueueId());
    }
}
