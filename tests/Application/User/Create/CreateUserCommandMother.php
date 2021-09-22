<?php

namespace Tests\Application\User\Create;

use App\Application\User\Create\CreateUserCommand;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserPassword;
use Tests\Domain\User\UserEmailMother;
use Tests\Domain\User\UserIdMother;
use Tests\Domain\User\UserPasswordMother;

final class CreateUserCommandMother
{
    public static function create(
        ?UserId $id = null,
        ?UserEmail $email = null,
        ?UserPassword $password = null
    ): CreateUserCommand
    {
        return new CreateUserCommand(
            $id?->value() ?? UserIdMother::create()->value(),
            $email?->value() ?? UserEmailMother::create()->value(),
            $password?->value() ?? UserPasswordMother::create()->value()
        );
    }
}
