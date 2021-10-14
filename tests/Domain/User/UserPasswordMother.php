<?php

declare(strict_types=1);

namespace Tests\Domain\User;

use App\Domain\User\UserPassword;
use Faker\Factory;

final class UserPasswordMother
{
    public static function create(?string $value = null): UserPassword
    {
        return new UserPassword($value ?? Factory::create()->password . "Aa19!.");
    }
}
