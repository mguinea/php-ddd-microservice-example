<?php

namespace App\Domain\User;

use App\Domain\Shared\DomainException;
use Throwable;

final class UserNotFound extends DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "" === $message ? "User not found" : $message;
        parent::__construct($message, $code, $previous);
    }
}
