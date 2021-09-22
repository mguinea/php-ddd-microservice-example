<?php

namespace Tests\Application\User\Get;

use App\Application\User\Get\GetUserByIdQuery;
use App\Domain\User\UserId;
use Tests\Domain\User\UserIdMother;

final class GetUserByIdQueryMother
{
    public static function create(
        ?UserId $id = null
    ): GetUserByIdQuery
    {
        return new GetUserByIdQuery(
            $id?->value() ?? UserIdMother::create()->value()
        );
    }
}
