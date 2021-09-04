<?php

declare(strict_types=1);

namespace App\Domain\User;

final class User
{
    public function __construct(
        private UserId $id,
        private UserEmail $email,
        private UserPassword $password,
        private array $rolesId = [],
        private array $permissionsId = []
    )
    {
    }

    public static function create(UserId $id, UserEmail $email, UserPassword $password): self
    {
        return new self(
            $id,
            $email,
            $password
        );
    }

    public function update(?UserEmail $email = null, ?UserPassword $password = null): void
    {
        $this->email = null === $email ? $this->email : $email;
        $this->password = null === $password ? $this->password : $password;
    }

    public static function fromPrimitives(string $id, string $email, string $password): self
    {
        return new self(
            UserId::fromValue($id),
            UserEmail::fromValue($email),
            UserPassword::fromValue($password)
        );
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function rolesId(): array
    {
        return $this->rolesId;
    }

    public function permissionsId(): array
    {
        return $this->permissionsId;
    }
}
