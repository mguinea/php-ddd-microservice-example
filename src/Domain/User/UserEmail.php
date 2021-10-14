<?php

namespace App\Domain\User;

use App\Domain\Shared\ValueObject\AbstractStringValueObject;

final class UserEmail extends AbstractStringValueObject
{
    public function __construct(string $value)
    {
        $this->assertIsValidEmail($value);
        parent::__construct($value);
    }

    private function assertIsValidEmail(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new UserEmailNotValid($value);
        }
    }
}
