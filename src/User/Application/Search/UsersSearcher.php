<?php

declare(strict_types=1);

namespace App\User\Application\Search;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Order;
use App\User\Domain\UserRepositoryInterface;

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
