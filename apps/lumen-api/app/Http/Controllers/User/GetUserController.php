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

    /**
     * @OA\Get(
     *   tags={"Users"},
     *   path="/lumen/api/v1/users/{id}",
     *   summary="Get user",
     *   description="This can only be done by the logged in user.",
     *   operationId="getUser",
     *   @OA\Parameter(
     *     description="ID of user to return",
     *     in="path",
     *     name="id",
     *     required=true,
     *     example="9cfa2bef-13d4-4d4f-a6e0-a6fb6e4bdcfe",
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\Schema(ref="#/components/schemas/UserResponse")
     *   ),
     *   @OA\Response(response=400, description="Invalid username supplied"),
     *   @OA\Response(response=404, description="User not found")
     * )
     */
    public function __invoke(Request $request, string $id): JsonResponse
    {
        /** @var UserResponse $userResponse */
        $userResponse = $this->queryBus->ask(
            new GetUserByIdQuery($id)
        );

        return new JsonResponse(
            ['user' => $userResponse->toArray()],
            Response::HTTP_OK,
            ['Access-Control-Allow-Origin' => '*']
        );
    }
}
