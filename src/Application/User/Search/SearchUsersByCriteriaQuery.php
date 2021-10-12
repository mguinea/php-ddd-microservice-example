<?php

declare(strict_types=1);

namespace App\Application\User\Search;

use App\Domain\Shared\Bus\Query\Query;

final class SearchUsersByCriteriaQuery implements Query
{
    public function __construct(
        private array $filters,
        private ?string $orderBy,
        private ?string $order,
        private ?int $limit,
        private ?int $offset
    ) {
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }

    public function order(): ?string
    {
        return $this->order;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }
}
