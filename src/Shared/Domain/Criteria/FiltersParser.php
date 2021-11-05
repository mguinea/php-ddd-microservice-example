<?php

namespace App\Shared\Domain\Criteria;

final class FiltersParser
{
    /**
     * @param string|null $filters
     * @return Filter[]
     */
    public static function fromUrl(?string $filters = null): array
    {
        return [];
        // TODO refactor this. convention: ?filters=email.gt:12;email.lt:12;name.eq:marc
        // if time, like 00:00:00, put inside "". Same with ;
        return array_map(function (string $filter) {
            $parts = explode(":", $filter);

            $field = explode(".", $parts[0])[0];
            $operator = explode(".", $parts[0])[1];
            $value = $parts[1];

            if ($operator === "gt") {
                $operator = ">";
            }

            if ($operator === "lt") {
                $operator = "<";
            }

            if ($operator === "eq") {
                $operator = "=";
            }

            return Filter::fromPrimitives(
                $field,
                $value,
                $operator
            );
        }, explode(";", $filters));
    }
}
