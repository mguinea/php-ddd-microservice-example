<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Shared\DomainException;
use Throwable;

final class UserPasswordNotValid extends DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "" === $message ? "Provided password is not valid." : $message;
        parent::__construct($message, $code, $previous);
    }
}
