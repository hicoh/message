<?php

namespace HiCo\Message\Files;

use HiCo\Message\Message;

class Files
{
    public static function getJobFolder(Message $message): string
    {
        return $message->getStream()->getSpec()->getOrganisationId() . '/' .
            $message->getStream()->getSpec()->getId() . '/' .
            $message->getJob()->getId();
    }

    public static function getJobFilePath(Message $message): string
    {
        return self::getJobFolder($message) . '/job.json';
    }

    public static function getEventPayloadFilePath(Message $message): string
    {
        return self::getJobFolder($message) . '/event_payload.json';
    }

    public static function getEventFolder(Message $message): string
    {
        return self::getJobFolder($message) . '/' . $message->getEvent()->getId();
    }

    public static function getEventFilePath(Message $message): string
    {
        return self::getEventFolder($message) . '/event.json';
    }

    public static function getEventPayloadInFilePath(Message $message): string
    {
        return self::getEventFolder($message) . '/payload_in.json';
    }

    public static function getEventPayloadOutFilePath(Message $message): string
    {
        return self::getEventFolder($message) . '/payload_out.json';
    }
}
