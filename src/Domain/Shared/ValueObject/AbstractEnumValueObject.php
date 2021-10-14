<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

abstract class AbstractEnumValueObject
{
    public function __construct(protected $value)
    {
        $this->ensureIsBetweenAcceptedValues($value);
    }

    abstract protected function ensureIsBetweenAcceptedValues($value): void;

    public static function fromString(string $value)
    {
        return new static($value);
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}
