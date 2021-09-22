<?php

namespace Tests\Application\User\Get;

use App\Application\User\Get\GetUserByIdQueryHandler;
use App\Application\User\Get\UserGetterById;
use App\Application\User\UserResponse;
use Tests\Domain\User\UserMother;
use Tests\UserUnitTestCase;

final class GetUserByIdQueryHandlerTest extends UserUnitTestCase
{
    private GetUserByIdQueryHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new GetUserByIdQueryHandler(
            new UserGetterById(
                $this->repository()
            )
        );
    }

    /** @test */
    public function itShouldGetAUserById(): void
    {
        $user = UserMother::create();
        $query = GetUserByIdQueryMother::create(
            $user->id()
        );
        $this->shouldFind($user->id(), $user);
        $userResponse = UserResponse::fromUser($user);

        $this->assertAskResponse($userResponse, $query, $this->handler);
    }
}
