<?php

declare(strict_types=1);

namespace Tests\Domain\User;

use App\Domain\User\UserEmail;
use Faker\Factory;

final class UserEmailMother
{
    public static function create(?string $value = null): UserEmail
    {
        return new UserEmail($value ?? Factory::create()->email);
    }
}
