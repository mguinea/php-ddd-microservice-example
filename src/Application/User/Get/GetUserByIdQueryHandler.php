<?php

declare(strict_types=1);

namespace App\Application\User\Get;

use App\Application\User\UserResponse;
use App\Domain\Shared\Bus\Query\QueryHandler;
use App\Domain\User\UserId;

final class GetUserByIdQueryHandler implements QueryHandler
{
    public function __construct(private UserGetterById $userGetterById)
    {
    }

    public function __invoke(GetUserByIdQuery $query): UserResponse
    {
        $id = UserId::fromValue($query->id());
        $user = $this->userGetterById->__invoke($id);

        return UserResponse::fromUser($user);
    }
}
