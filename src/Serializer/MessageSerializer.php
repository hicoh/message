<?php

namespace HiCo\Message\Serializer;

use HiCo\Message\Event;
use HiCo\Message\EventEntity;
use HiCo\Message\Job;
use HiCo\Message\Key;
use HiCo\Message\Message;
use HiCo\Message\Payload;
use HiCo\Message\PayloadBase;
use HiCo\Message\Spec;
use HiCo\Message\Status;
use HiCo\Message\Stream;
use HiCo\Message\SystemSetting;
use HiCo\Message\User;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class MessageSerializer implements SerializerInterface
{
    /**
     * @throws \Exception
     */
    public function serialize($data, string $format, array $context = []): string
    {
        if (!$data instanceof Message) {
            throw new \Exception(sprintf('Class (%s) can not be serialized using MessageSerializer', get_class($data)));
        }
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())];

        return (new Serializer($normalizers, $encoders))->serialize(
            $data,
            'json',
            [
                'ignored_attributes' => ['scheduledEvents'],
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                },
            ]
        );
    }

    public function deserialize($data, string $type, string $format = null, array $context = []): Message
    {
        $message = new Message();
        $stream = new Stream();

        // Stream
        $stream->setDestination($this->setSystemSettings($data, 'destination'));
        $stream->setSource($this->setSystemSettings($data, 'source'));

        $spec = (new Spec())
            ->setOrganisationId($data['stream']['spec']['organisation_id'])
            ->setDataType($data['stream']['spec']['data_type'])
            ->setId($data['stream']['spec']['id'])
            ->setTitle($data['stream']['spec']['title'])
            ->setTransformationId($data['stream']['spec']['transformation_id'])
            ->setTransformationVersion($data['stream']['spec']['transformation_version']);

        if (isset($data['stream']['spec']['dedicated_queue_id'])) {
            $spec->setDedicatedQueueId($data['stream']['spec']['dedicated_queue_id']);
        }

        $stream->setSpec($spec);

        if (isset($data['stream']['user']['additional_settings']) &&
            is_array($data['stream']['user']['additional_settings'])) {
            $stream->setUser((new User())->setAdditionalSettings($data['stream']['user']['additional_settings']));
        } else {
            $stream->setUser((new User())->setAdditionalSettings(null));
        }

        $message->setStream($stream);

        // Job
        if (isset($data['job']['id'])) {
            $message->setJob((new Job())->setId($data['job']['id'])->setStage($data['job']['stage']));
        }
        if (isset($data['job']['status']) && is_array($data['job']['status'])) {
            $status = new Status();
            if (isset($data['job']['status']['status'])) {
                $status->setStatus($data['job']['status']['status']);
            }
            if (isset($data['job']['status']['message'])) {
                $status->setMessage($data['job']['status']['message']);
            }
            if (isset($data['job']['status']['d_id'])) {
                $status->setDId($data['job']['status']['d_id']);
            }
            if (isset($data['job']['status']['d_pid'])) {
                $status->setDPid($data['job']['status']['d_pid']);
            }
            if (isset($data['job']['status']['flag'])) {
                $status->setFlag($data['job']['status']['flag']);
            }
            $message->getJob()->setStatus($status);
        }

        // Event
        if (isset($data['event']['id'])) {
            $message->setEvent((new Event())->setId($data['event']['id']));
        }
        if (isset($data['event']['status']) && is_array($data['event']['status'])) {
            $status = new Status();
            if (isset($data['event']['status']['status'])) {
                $status->setStatus($data['event']['status']['status']);
            }
            if (isset($data['event']['status']['message'])) {
                $status->setMessage($data['event']['status']['message']);
            }
            if (isset($data['event']['status']['d_id'])) {
                $status->setDId($data['event']['status']['d_id']);
            }
            if (isset($data['event']['status']['d_pid'])) {
                $status->setDPid($data['event']['status']['d_pid']);
            }
            if (isset($data['event']['status']['flag'])) {
                $status->setFlag($data['event']['status']['flag']);
            }
            $message->getEvent()->setStatus($status);
        }
        if (isset($data['event']['last'])) {
            $message->getEvent()->setLast($data['event']['last']);
        }
        if (isset($data['event']['aggregated'])) {
            $message->getEvent()->setAggregated($data['event']['aggregated']);
        }
        if (isset($data['event']['parent_event'])) {
            $message->getEvent()->setParentEvent($data['event']['parent_event']);
        }
        if (isset($data['event']['parent_event_id'])) {
            $message->getEvent()->setParentEventId($data['event']['parent_event_id']);
        }
        if (isset($data['event']['original_event_id'])) {
            $message->getEvent()->setOriginalEventId($data['event']['original_event_id']);
        }
        if (isset($data['event']['duplicated_event_id_list'][0])) {
            $message->getEvent()->setDuplicatedEventIdList($data['event']['duplicated_event_id_list']);
        }

        // Event Entity
        $eventEntity = new EventEntity();
        if (isset($data['event_entity']['id'])) {
            $eventEntity->setId($data['event_entity']['id']);
        }
        if (isset($data['event_entity']['destination_id'])) {
            $eventEntity->setDestinationId($data['event_entity']['destination_id']);
        }
        if (isset($data['event_entity']['destination_parent_id'])) {
            $eventEntity->setDestinationParentId($data['event_entity']['destination_parent_id']);
        }
        $message->setEventEntity($eventEntity);

        // Payload
        $in = new PayloadBase();
        if (isset($data['payload']['in']['path'])) {
            $in = $in->setPath($data['payload']['in']['path']);
        }
        if (isset($data['payload']['in']['data'])) {
            $in = $in->setData($data['payload']['in']['data']);
        }
        if (isset($data['payload']['in']['format'])) {
            $in = $in->setFormat($data['payload']['in']['format']);
        }

        $out = new PayloadBase();
        if (isset($data['payload']['out']['path'])) {
            $out = $out->setPath($data['payload']['out']['path']);
        }
        if (isset($data['payload']['out']['data'])) {
            $out = $out->setData($data['payload']['out']['data']);
        }
        if (isset($data['payload']['out']['format'])) {
            $out = $out->setFormat($data['payload']['out']['format']);
        }

        $webHookEvent = new PayloadBase();
        if (isset($data['payload']['web_hook_event']['path'])) {
            $webHookEvent = $webHookEvent->setPath($data['payload']['web_hook_event']['path']);
        }
        if (isset($data['payload']['web_hook_event']['data'])) {
            $webHookEvent = $webHookEvent->setData($data['payload']['web_hook_event']['data']);
        }
        if (isset($data['payload']['web_hook_event']['format'])) {
            $webHookEvent = $webHookEvent->setFormat($data['payload']['web_hook_event']['format']);
        }

        $message->setPayload((new Payload())->setIn($in)->setOut($out)->setWebHookEvent($webHookEvent));

        return $message;
    }

    public function setSystemSettings(?array $data, string $systemDestination): SystemSetting
    {
        $systemSettings = new SystemSetting();
        if (isset($data['stream'][$systemDestination]['function'])) {
            $systemSettings->setFunction($data['stream'][$systemDestination]['function']);
        }
        $key = new Key();
        if (isset($data['stream'][$systemDestination]['key']['id'])) {
            $key->setId($data['stream'][$systemDestination]['key']['id']);
        }
        if (isset($data['stream'][$systemDestination]['key']['title'])) {
            $key->setTitle($data['stream'][$systemDestination]['key']['title']);
        }
        if (isset($data['stream'][$systemDestination]['key']['credentials'])) {
            $key->setCredentials($data['stream'][$systemDestination]['key']['credentials']);
        }
        $systemSettings->setKey($key);
        if (isset($data['stream'][$systemDestination]['options'])) {
            $systemSettings->setOptions($data['stream'][$systemDestination]['options']);
        }
        if (isset($data['stream'][$systemDestination]['queue_url'])) {
            $systemSettings->setQueueUrl($data['stream'][$systemDestination]['queue_url']);
        }
        if (isset($data['stream'][$systemDestination]['system'])) {
            $systemSettings->setSystem($data['stream'][$systemDestination]['system']);
        }
        if (isset($data['stream'][$systemDestination]['trigger'])) {
            $systemSettings->setTrigger($data['stream'][$systemDestination]['trigger']);
        }
        if (isset($data['stream'][$systemDestination]['aggregate_events'])) {
            $systemSettings->setAggregateEvents($data['stream'][$systemDestination]['aggregate_events']);
        }
        if (isset($data['stream'][$systemDestination]['pagination'])) {
            $systemSettings->setPagination($data['stream'][$systemDestination]['pagination']);
        }
        if (isset($data['stream'][$systemDestination]['url'])) {
            $systemSettings->setUrl($data['stream'][$systemDestination]['url']);
        }
        if (isset($data['stream'][$systemDestination]['additional_settings']) &&
            is_array($data['stream'][$systemDestination]['additional_settings'])) {
            $systemSettings->setAdditionalSettings($data['stream'][$systemDestination]['additional_settings']);
        }

        return $systemSettings;
    }
}
