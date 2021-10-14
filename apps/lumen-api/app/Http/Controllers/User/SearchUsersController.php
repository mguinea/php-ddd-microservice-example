<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\User;

use App\Application\User\Search\SearchUsersByCriteriaQuery;
use App\Application\User\UsersResponse;
use App\Domain\Shared\Bus\Query\QueryBus;
use Apps\LumenApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class SearchUsersController extends Controller
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $filters = $request->input('filters');
        $orderBy = $request->input('order_by');
        $order = $request->input('order');
        $limit  = $request->input('limit');
        $offset = $request->input('offset');

        /** @var UsersResponse $usersResponse */
        $usersResponse = $this->queryBus->ask(
            new SearchUsersByCriteriaQuery(
                null === $filters ? null : (string) $filters,
                null === $orderBy ? null : (string) $orderBy,
                null === $order ? null: (string) $order,
                null === $limit ? null : (int) $limit,
                null === $offset ? null : (int) $offset
            )
        );

        return new JsonResponse(
            [
                'users' => $usersResponse->toArray()
            ],
            Response::HTTP_OK
        );
    }
}
