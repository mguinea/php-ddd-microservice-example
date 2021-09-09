<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\User;

use App\Application\User\Update\UpdateUserCommand;
use App\Domain\Shared\Bus\Command\CommandBus;
use App\Domain\Shared\RequestValidator;
use Apps\LumenApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class UpdateUserController extends Controller
{
    public function __construct(
        private CommandBus $commandBus,
        private RequestValidator $validator
    ) {
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $this->validator->validate(
            $request,
            [
                'email' => 'email'
            ]
        );

        $email = $request->get('email');
        $password = $request->get('password');

        $this->commandBus->dispatch(
            new UpdateUserCommand(
                $id,
                $email,
                $password
            )
        );

        return new JsonResponse(
            [
                'data' => [
                    'message' => 'User update request sent.'
                ]
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
