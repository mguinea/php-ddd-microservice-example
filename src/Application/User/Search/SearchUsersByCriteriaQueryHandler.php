<?php

declare(strict_types=1);

namespace App\Application\User\Search;

use App\Application\User\UsersResponse;
use App\Domain\Shared\Bus\Query\QueryHandler;
use App\Domain\Shared\Criteria\Filter;
use App\Domain\Shared\Criteria\Order;

final class SearchUsersByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private UsersSearcher $searcher)
    {
    }

    public function __invoke(SearchUsersByCriteriaQuery $query): UsersResponse
    {
        // TODO decide how to send filters
        // age.gt=21&age.lt=40
        /*
        dd($query->filters());
        $filters = array_map($query->filters(), function($filter) {
            return Filter::fromPrimitives(
                $filter['field'],
                $filter['value'],
                $filter['operator']
            );
        });
        //*/
        $filters = [];
        $order = Order::fromValues($query->orderBy(), $query->order());
        $users = $this->searcher->__invoke($filters, $order, $query->limit(), $query->offset());

        return UsersResponse::fromUsers($users);
    }
}
