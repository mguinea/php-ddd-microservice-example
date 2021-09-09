<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\User;

use App\Application\User\Create\CreateUserCommand;
use App\Domain\Shared\Bus\Command\CommandBus;
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

        $this->commandBus->dispatch(
            new CreateUserCommand(
                $id,
                $email,
                $password
            )
        );

        return new JsonResponse(
            [
                'user' => [
                    'id' => $id
                ]
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
