<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Shared\Bus\Query\Response;
use App\Domain\User\User;

final class UserResponse implements Response
{
    public function __construct(
        private string $id,
        private string $email
    ) {
    }

    public static function fromUser(User $user): self
    {
        return new self(
            $user->id()->value(),
            $user->email()->value()
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'user' => [
                'id' => $this->id,
                'email' => $this->email
            ]
        ];
    }
}
