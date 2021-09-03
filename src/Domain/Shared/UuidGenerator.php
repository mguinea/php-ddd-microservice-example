<?php

namespace App\Domain\Shared;

interface UuidGenerator
{
    public function generate(): string;
}
