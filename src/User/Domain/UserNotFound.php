<?php

namespace App\User\Domain;

use App\Shared\Domain\AbstractDomainException;
use Throwable;

final class UserNotFound extends AbstractDomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "" === $message ? "User not found" : $message;
        parent::__construct($message, $code, $previous);
    }
}
