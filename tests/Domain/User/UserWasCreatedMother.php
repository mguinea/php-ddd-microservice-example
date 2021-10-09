<?php

namespace Tests\Domain\User;

use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserWasCreated;

final class UserWasCreatedMother
{
    public static function create(
        ?UserId $id = null,
        ?UserEmail $email = null,
        string $eventId = null,
        string $occurredOn = null
    ): UserWasCreated
    {
        return new UserWasCreated(
            $id ?? UserIdMother::create(),
            $email ?? UserEmailMother::create(),
            $eventId,
            $occurredOn
        );
    }
}
