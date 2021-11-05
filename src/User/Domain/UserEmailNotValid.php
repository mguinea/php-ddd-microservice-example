<?php

declare(strict_types=1);

namespace App\User\Domain;

use App\Shared\Domain\DomainException;
use Throwable;

final class UserEmailNotValid extends DomainException
{
    public function __construct($value = "", $code = 0, Throwable $previous = null)
    {
        $message = "Provided email " . $value . " is not valid.";
        parent::__construct($message, $code, $previous);
    }
}
