<?php

declare(strict_types=1);

namespace App\User\Application\Get;

use App\User\Application\UserResponse;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\User\Domain\UserId;

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
