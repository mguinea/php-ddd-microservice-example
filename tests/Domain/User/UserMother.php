<?php

declare(strict_types=1);

namespace Tests\Domain\User;

use App\Domain\User\User;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserPassword;

final class UserMother
{
    public static function create(
        ?UserId $id = null,
        ?UserEmail $email = null,
        ?UserPassword $password = null
    ): User
    {
        return new User(
            $id ?? UserIdMother::create(),
            $email ?? UserEmailMother::create(),
            $password ?? UserPasswordMother::create()
        );
    }
}
