<?php

namespace HiCo\Message\Unit\Serializer;

use HiCo\Message\Event;
use HiCo\Message\EventEntity;
use HiCo\Message\Job;
use HiCo\Message\Message;
use HiCo\Message\Payload;
use HiCo\Message\PayloadBase;
use HiCo\Message\Serializer\MessageSerializer;
use HiCo\Message\Spec;
use HiCo\Message\Status;
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
        $eventEntity = $this->createEventEntity();
        $payload = $this->createPayload();
        $message = new Message();
        $message->setStream($stream);
        $message->setJob($job);
        $message->setEvent($event);
        $message->setEventEntity($eventEntity);
        $message->setPayload($payload);
        $this->assertSame($this->expectedResult(), $messageSerializer->serialize($message, Message::class));
    }

    public function testSeralizeThrowsExceptionIfWrongClassPassed()
    {
        $this->expectException(\Exception::class);
        $messageSerializer = new MessageSerializer();
        $messageSerializer->serialize(new Event(), Event::class);
    }

    public function expectedResult(): string
    {
        return '{"stream":{"destination":{"additional_settings":{"settings":true},"options":"options","queue_url":"queue-url","system":"system","trigger":"trigger","aggregate_events":true,"pagination":10,"url":"url","function":"function","key_id":"key-id"},"source":{"additional_settings":{"settings":true},"options":"options","queue_url":"queue-url","system":"system","trigger":"trigger","aggregate_events":true,"pagination":10,"url":"url","function":"function","key_id":"key-id"},"spec":{"organisation_id":"organisation-id","data_type":"data-type","id":"id","title":"title","transformation_id":"transformation-id"},"user":{"additional_settings":{"settings":true}}},"job":{"id":"id","stage":"source","status":{"status":"status","message":"message","d_id":"did","d_pid":"dpid","flag":"flag"}},"event":{"id":"id","status":{"status":"status","message":"message","d_id":"did","d_pid":"dpid","flag":"flag"},"last":false,"aggregated":0,"parent_event_id":"parent-event-id","parent_event":true},"event_entity":{"id":"id","destination_id":"destination-id","destination_parent_id":"destination-parent-id"},"payload":{"in":{"path":"path","data":"data","format":"format"},"out":{"path":"path","data":"data","format":"format"},"web_hook_event":{"path":"path","data":"data","format":"format"}},"stage_system_setting":{"additional_settings":{"settings":true},"options":"options","queue_url":"queue-url","system":"system","trigger":"trigger","aggregate_events":true,"pagination":10,"url":"url","function":"function","key_id":"key-id"}}';
    }

    public function createSystemSetting(): SystemSetting
    {
        return (new SystemSetting())->setFunction('function')
            ->setKeyId('key-id')
            ->setOptions('options')
            ->setQueueUrl('queue-url')
            ->setSystem('system')
            ->setTrigger('trigger')
            ->setAggregateEvents(true)
            ->setPagination(10)
            ->setUrl('url')
            ->setAdditionalSettings(['settings' => true]);
    }

    public function createSpec(): Spec
    {
        return (new Spec())->setOrganisationId('organisation-id')
            ->setDataType('data-type')
            ->setId('id')
            ->setTitle('title')
            ->setTransformationId('transformation-id');
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
            ->setStage(Job::STAGE_JOB)
            ->setStatus($this->createStatus());
    }

    public function createStatus(): Status
    {
        return (new Status())->setStatus('status')
            ->setMessage('message')
            ->setDId('did')
            ->setDPid('dpid')
            ->setFlag('flag');
    }

    public function createEvent(): Event
    {
        return (new Event())->setId('id')
            ->setScheduleEvents([])
            ->setStatus($this->createStatus())
            ->setLast(false)
            ->setAggregated(0)
            ->setParentEvent(true)
            ->setParentEventId('parent-event-id');
    }

    public function createEventEntity(): EventEntity
    {
        return (new EventEntity())->setId('id')
            ->setDestinationId('destination-id')
            ->setDestinationParentId('destination-parent-id');
    }

    public function createPayload(): Payload
    {
        return (new Payload())->setIn($this->createPayloadBase())
            ->setOut($this->createPayloadBase())
            ->setWebHookEvent($this->createPayloadBase());
    }

    public function createPayloadBase(): PayloadBase
    {
        return (new PayloadBase())->setPath('path')
            ->setData('data')
            ->setFormat('format');
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

    public function testDenormalizeSetsEventEntityCorrectly()
    {
        $this->assertInstanceOf(EventEntity::class, $this->message->getEventEntity());
    }

    public function testDenormalizeSetsPayloadCorrectly()
    {
        $this->assertInstanceOf(Payload::class, $this->message->getPayload());
    }

    public function testAdditionalSettingsGetSetToNullWhenNoUserSettingsPassed()
    {
        $data = json_decode($this->expectedResult(), true);
        $data['stream']['user']['additional_settings'] = null;
        $messageNormalizer = new MessageSerializer();
        $message = $messageNormalizer->deserialize($data, Message::class);
        $this->assertNull($message->getStream()->getUser()->getAdditionalSettings());
    }

    public function testAggregatedWhenNoValueIsPassed()
    {
        $data = json_decode($this->expectedResult(), true);
        unset($data['event']['aggregated']);
        $messageNormalizer = new MessageSerializer();
        $message = $messageNormalizer->deserialize($data, Message::class);
        $this->assertSame($message->getEvent()->getAggregated(), 0);
    }
}