<?php

namespace HiCo\Message\Helper;

use HiCo\Message\Message;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MessageHelper
{
    public static function serializeMessage(Message $message): string
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())];

        return (new Serializer($normalizers, $encoders))->serialize(
            $message,
            'json',
            [
                'ignored_attributes' => ['scheduledEvents'],
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                },
            ]
        );
    }
}
