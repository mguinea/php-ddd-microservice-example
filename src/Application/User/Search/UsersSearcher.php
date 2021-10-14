<?php

declare(strict_types=1);

namespace App\Application\User\Search;

use App\Domain\Shared\Criteria\Criteria;
use App\Domain\Shared\Criteria\Order;
use App\Domain\User\UserRepositoryInterface;

final class UsersSearcher
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function __invoke(array $filters, Order $order, ?int $limit, ?int $offset): array
    {
        $criteria = new Criteria($filters, $order, $limit, $offset);

        return $this->repository->searchByCriteria($criteria);
    }
}
