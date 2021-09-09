<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\User;

use App\Application\User\Get\GetUserByIdQuery;
use App\Application\User\UserResponse;
use App\Domain\Shared\Bus\Query\QueryBus;
use Apps\LumenApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class GetUserController extends Controller
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        /** @var UserResponse $userResponse */
        $userResponse = $this->queryBus->ask(
            new GetUserByIdQuery($id)
        );

        return new JsonResponse(
            $userResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
