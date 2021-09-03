<?php

namespace App\Domain\Shared\Bus\Query;

interface QueryBus
{
    public function ask(Query $query): ?Response;
}
