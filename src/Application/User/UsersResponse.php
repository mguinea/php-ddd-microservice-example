<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Shared\Bus\Query\Response;
use App\Domain\User\User;
use function array_map;

final class UsersResponse implements Response
{
    public function __construct(private array $usersResponse)
    {
    }

    public static function fromUsers(array $users): self
    {
        $usersResponse = array_map(function(User $user) {
            return UserResponse::fromUser($user);
        }, $users);

        return new self($usersResponse);
    }

    public function toArray(): array
    {
        return array_map(function(UserResponse $userResponse) {
            return $userResponse->toArray();
        }, $this->usersResponse);
    }
}
