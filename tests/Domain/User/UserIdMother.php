<?php

namespace Tests\Domain\User;

use App\Domain\User\UserId;
use Faker\Factory;

final class UserIdMother
{
    public static function create(?string $value = null): UserId
    {
        return new UserId($value ?? Factory::create()->uuid);
    }
}
