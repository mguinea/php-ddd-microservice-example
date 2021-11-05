<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

final class Criteria
{
    public function __construct(
        private array $filters,
        private Order $order,
        private ?int $limit = null,
        private ?int $offset = null
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

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }
}
