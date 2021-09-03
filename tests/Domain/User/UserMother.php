<?php

declare(strict_types=1);

namespace Tests\Domain\User;

use App\Domain\User\User;
use App\Domain\User\UserId;

final class UserMother
{
    public static function create(?UserId $id = null): User
    {
        return new User(
            $id?->value() ?? UserIdMother::create()->value()
        );
    }
}
