<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Shared\ValueObject\AbstractStringValueObject;

final class UserPassword extends AbstractStringValueObject
{
    public function __construct(string $value)
    {
        $this->assertIsValidPassword($value);
        parent::__construct($value);
    }

    private function assertIsValidPassword(string $value): void
    {
        $uppercase = preg_match('@[A-Z]@', $value);
        $lowercase = preg_match('@[a-z]@', $value);
        $number    = preg_match('@[0-9]@', $value);
        $specialChars = preg_match('@[^\w]@', $value);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($value) < 8) {
            throw new UserPasswordNotValid();
        }
    }
}
