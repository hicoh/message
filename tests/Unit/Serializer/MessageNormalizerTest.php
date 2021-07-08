<?php

namespace HiCo\Message\Unit\Serializer;

use HiCo\Message\Event;
use HiCo\Message\EventEntity;
use HiCo\Message\Job;
use HiCo\Message\Message;
use HiCo\Message\Payload;
use HiCo\Message\Serializer\MessageNormalizer;
use HiCo\Message\Stream;

class MessageNormalizerTest extends \PHPUnit\Framework\TestCase
{
    private $message;

    protected function setUp(): void
    {
        $messageNormalizer = new MessageNormalizer();
        $this->message = $messageNormalizer->denormalize($this->getDataArray(), Message::class);
    }

    public function getDataArray(): array
    {
        return json_decode('{"stream":{"destination":{"additional_settings":{"settings":true},"options":"options","queue_url":"queue-url","system":"system","trigger":"trigger","url":"url","function":"function","key_id":"key-id"},"source":{"additional_settings":{"settings":true},"options":"options","queue_url":"queue-url","system":"system","trigger":"trigger","url":"url","function":"function","key_id":"key-id"},"spec":{"organisation_id":"organisation-id","data_type":"data-type","id":"id","title":"title","transformation_id":"transformation-id"},"user":{"additional_settings":{"settings":true}}},"job":{"id":"id","stage":"source","status":{"status":"status","message":"message","d_id":"did","d_pid":"dpid","flag":"flag"}},"event":{"id":"id","status":{"status":"status","message":"message","d_id":"did","d_pid":"dpid","flag":"flag"},"last":false},"event_entity":{"id":"id","destination_id":"destination-id","destination_parent_id":"destination-parent-id"},"payload":{"in":{"path":"path","data":"data","format":"format"},"out":{"path":"path","data":"data","format":"format"},"web_hook_event":{"path":"path","data":"data","format":"format"}},"stage_system_setting":{"additional_settings":{"settings":true},"options":"options","queue_url":"queue-url","system":"system","trigger":"trigger","url":"url","function":"function","key_id":"key-id"}}', true);
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

    public function testSupportsDenormalizationReturnsTrueWhenMessageClassPassed()
    {
        $this->assertTrue((new MessageNormalizer())->supportsDenormalization('', Message::class));
    }

    public function testSupportsDenormalizationReturnsFalseWhenMessageClassNotPassed()
    {
        $this->assertFalse((new MessageNormalizer())->supportsDenormalization('', 'RandomClassName'));
    }

    public function testAdditionalSettingsGetSetToNullWhenNoUserSettingsPassed()
    {
        $data = $this->getDataArray();
        $data['stream']['user']['additional_settings'] = null;
        $messageNormalizer = new MessageNormalizer();
        $message = $messageNormalizer->denormalize($data, Message::class);
        $this->assertNull($message->getStream()->getUser()->getAdditionalSettings());
    }
}
