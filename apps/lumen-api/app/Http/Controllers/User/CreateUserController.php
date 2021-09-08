<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\User;

use App\Application\User\Create\CreateUserCommand;
use App\Application\User\Get\GetUserByIdQuery;
use App\Application\User\UserResponse;
use App\Domain\Shared\Bus\Command\CommandBus;
use App\Domain\Shared\Bus\Query\QueryBus;
use App\Domain\Shared\RequestValidator;
use App\Domain\Shared\UuidGenerator;
use Apps\LumenApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class CreateUserController extends Controller
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus,
        private UuidGenerator $generator,
        private RequestValidator $validator
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->validator->validate(
            $request,
            [
                'email' => 'required|email|unique:mysql.users,email',
                'password' => 'required'
            ]
        );

        $id = $request->get('id', $this->generator->generate());
        $email = $request->get('email');
        $password = $request->get('password');
        $rolesId = $request->get('roles_id', []);

        $this->commandBus->dispatch(
            new CreateUserCommand(
                $id,
                $email,
                $password,
                $rolesId
            )
        );

        /** @var UserResponse $userResponse */
        $userResponse = $this->queryBus->ask(
            new GetUserByIdQuery(
                $id
            )
        );

        return new JsonResponse(
            $userResponse->toArray(),
            Response::HTTP_CREATED
        );
    }
}
