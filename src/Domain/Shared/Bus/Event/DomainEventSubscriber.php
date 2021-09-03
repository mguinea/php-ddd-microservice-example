<?php

namespace App\Domain\Shared\Bus\Event;

interface DomainEventSubscriber
{
    public static function subscribedTo(): array;
}
