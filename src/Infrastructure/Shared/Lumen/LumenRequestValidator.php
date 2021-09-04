<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Lumen;

use App\Domain\Shared\RequestValidator;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class LumenRequestValidator implements RequestValidator
{
    use ProvidesConvenienceMethods;

    public function validate($request, array $rules, array $messages = [], array $customAttributes = []): void
    {
        $validator = Validator::make($request->all(), $rules);

        if (true === $validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
    }
}