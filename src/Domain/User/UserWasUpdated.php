<?php

namespace App\Domain\User;

use App\Domain\Shared\Bus\Event\DomainEvent;

final class UserWasUpdated extends DomainEvent
{
    public function __construct(
        private string $id,
        private string $email,
        string $eventId = null,
        string $occurredOn = null
    )
    {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function fromPrimitives(string $aggregateId, array $body, string $eventId = null, string $occurredOn = null): DomainEvent
    {
        return new self($aggregateId, $body['email'], $eventId, $occurredOn);
    }

    public function eventName(): string
    {
        return 'user.was_updated';
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email
        ];
    }


    public function email(): string
    {
        return $this->email;
    }
}
