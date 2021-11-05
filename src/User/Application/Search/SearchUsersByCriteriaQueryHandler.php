<?php

declare(strict_types=1);

namespace App\User\Application\Search;

use App\User\Application\UsersResponse;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Criteria\Filter;
use App\Shared\Domain\Criteria\Order;

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
