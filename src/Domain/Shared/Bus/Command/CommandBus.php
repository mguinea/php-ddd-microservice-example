<?php

namespace App\Domain\Shared\Bus\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
