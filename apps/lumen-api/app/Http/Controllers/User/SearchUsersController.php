<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\User;

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
        /** @var UsersResponse $usersResponse */
        $usersResponse = $this->queryBus->ask(
            new SearchUsersByCriteria()
        );

        return new JsonResponse(
            $usersResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
