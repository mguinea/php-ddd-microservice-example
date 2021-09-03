<?php

namespace App\Domain\Shared;

interface RequestValidator
{
    public function validate($request, array $rules, array $messages = [], array $customAttributes = []): void;
}
