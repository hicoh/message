<?php

namespace HiCo\Message\Unit;

use HiCo\Message\Job;
use HiCo\Message\Status;

class JobTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAndGetId()
    {
        $job = new Job();
        $job->setId('1234');
        $this->assertSame('1234', $job->getId());
    }

    public function testGetStageReturnsSourceIfNotSet()
    {
        $job = (new Job())->setStage(Job::STAGE_JOB);
        $this->assertSame(Job::STAGE_JOB, $job->getStage());
    }

    public function testSetStageThrowsExceptionIfInvalidStagePassed()
    {
        $this->expectException(\Exception::class);
        (new Job())->setStage('invalid_stage');
    }

    public function testSetAndGetStatus()
    {
        $status = new Status();
        $job = (new Job())->setStatus($status);
        $this->assertSame($status, $job->getStatus());
    }
}
