<?php

namespace HiCo\Message\Unit\Serializer;

use HiCo\Message\Event;
use HiCo\Message\Job;
use HiCo\Message\Key;
use HiCo\Message\Message;
use HiCo\Message\Serializer\MessageSerializer;
use HiCo\Message\Spec;
use HiCo\Message\Stream;
use HiCo\Message\SystemSetting;
use HiCo\Message\User;
use PHPUnit\Framework\TestCase;

class MessageSerializerTest extends TestCase
{
    private Message $message;

    protected function setUp(): void
    {
        $messageNormalizer = new MessageSerializer();
        $this->message = $messageNormalizer->deserialize(json_decode($this->expectedResult(), true), Message::class);
    }

    public function testSerializeMessage()
    {
        $messageSerializer = new MessageSerializer();
        $stream = $this->createStream();
        $job = $this->createJob();
        $event = $this->createEvent();
        $message = new Message();
        $message->setStream($stream);
        $message->setJob($job);
        $message->setEvent($event);
        $this->assertSame($this->expectedResult(), $messageSerializer->serialize($message, Message::class));
    }

    public function testSerializeThrowsExceptionIfWrongClassPassed()
    {
        $this->expectException(\Exception::class);
        $messageSerializer = new MessageSerializer();
        $messageSerializer->serialize(new Event(), Event::class);
    }

    public function expectedResult(): string
    {
        return '{"stream":{"destination":{"additional_settings":{"settings":true},"queue_url":"queue-url","system":"system","aggregate_events":true,"pagination":10,"function":"function","key":{"id":"123","title":"test","credentials":{"name":"test"}}},"source":{"additional_settings":{"settings":true},"queue_url":"queue-url","system":"system","aggregate_events":true,"pagination":10,"function":"function","key":{"id":"123","title":"test","credentials":{"name":"test"}}},"spec":{"organisation_id":"organisation-id","data_type":"data-type","id":"id","transformation_id":"transformation-id","transformation_version":"transformation-version","dedicated_queue_id":"dedicated-queue-id"},"user":{"additional_settings":{"settings":true}}},"job":{"id":"id","stage":"source"},"event":{"id":"id"}}';
    }

    public function createSystemSetting(): SystemSetting
    {
        return (new SystemSetting())->setFunction('function')
            ->setKey((new Key())->setId('123')->setTitle('test')->addCredentials('name', 'test'))
            ->setQueueUrl('queue-url')
            ->setSystem('system')
            ->setAggregateEvents(true)
            ->setPagination(10)
            ->setAdditionalSettings(['settings' => true]);
    }

    public function createSpec(): Spec
    {
        return (new Spec())->setOrganisationId('organisation-id')
            ->setDataType('data-type')
            ->setId('id')
            ->setTransformationId('transformation-id')
            ->setTransformationVersion('transformation-version')
            ->setDedicatedQueueId('dedicated-queue-id');
    }

    public function createUser(): User
    {
        return (new User())->setAdditionalSettings(['settings' => true]);
    }

    public function createStream(): Stream
    {
        return (new Stream())->setDestination($this->createSystemSetting())
            ->setSource($this->createSystemSetting())
            ->setSpec($this->createSpec())
            ->setUser($this->createUser());
    }

    public function createJob(): Job
    {
        return (new Job())->setId('id')
            ->setStage(Job::STAGE_JOB);
    }

    public function createEvent(): Event
    {
        return (new Event())->setId('id');
    }

    public function testDenormalizeReturnsMessage()
    {
        $this->assertInstanceOf(Message::class, $this->message);
    }

    public function testDenormalizeSetsStreamCorrectly()
    {
        $this->assertInstanceOf(Stream::class, $this->message->getStream());
    }

    public function testDenormalizeSetsJobCorrectly()
    {
        $this->assertInstanceOf(Job::class, $this->message->getJob());
    }

    public function testDenormalizeSetsEventCorrectly()
    {
        $this->assertInstanceOf(Event::class, $this->message->getEvent());
    }

    public function testAdditionalSettingsGetSetToNullWhenNoUserSettingsPassed()
    {
        $data = json_decode($this->expectedResult(), true);
        $data['stream']['user']['additional_settings'] = null;
        $messageNormalizer = new MessageSerializer();
        $message = $messageNormalizer->deserialize($data, Message::class);
        $this->assertNull($message->getStream()->getUser()->getAdditionalSettings());
    }
}