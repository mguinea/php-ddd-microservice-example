<?php

declare(strict_types=1);

namespace App\Application\User\Search;

use App\Domain\Shared\Bus\Query\QueryHandler;
use App\Domain\Shared\Criteria\Filter;
use App\Domain\Shared\Criteria\Order;

final class SearchUsersByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private UsersSearcher $searcher)
    {
    }

    public function __invoke(SearchUsersByCriteriaQuery $query): array
    {
        dd($query->filters());
        $filters = array_map($query->filters(), function($filter) {
            return Filter::fromPrimitives(
                $filter['field'],
                $filter['value'],
                $filter['operator']
            );
        });
        $order = Order::fromValues($query->orderBy(), $query->order());

        return $this->searcher->__invoke($filters, $order, $query->limit(), $query->offset());
    }
}
