<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Messenger;

use App\Shared\Infrastructure\AbstractInfrastructureException;
use Throwable;

final class CommandNotRegistered extends AbstractInfrastructureException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "" === $message ? "Command not registered" : $message;
        parent::__construct($message, $code, $previous);
    }
}
