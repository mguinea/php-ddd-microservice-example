<?php

declare(strict_types=1);

namespace App\Domain\Shared\Criteria;

final class Criteria
{
    public function __construct(
        private array $filters,
        private Order $order,
        private ?int $offset,
        private ?int $limit
    ) {
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }
}
