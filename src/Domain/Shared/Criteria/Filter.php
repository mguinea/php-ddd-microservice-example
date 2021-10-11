<?php

declare(strict_types=1);

namespace App\Domain\Shared\Criteria;

final class Filter
{
    public function __construct(
        private FilterField $field,
        private FilterOperator $operator,
        private FilterValue $value
    ) {
    }

    public static function fromPrimitives(string $field, string $value, string $operator = '='): self
    {
        return new self(
            new FilterField($field),
            new FilterOperator($operator),
            new FilterValue($value)
        );
    }

    public function field(): FilterField
    {
        return $this->field;
    }

    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    public function value(): FilterValue
    {
        return $this->value;
    }
}
