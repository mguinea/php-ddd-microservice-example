<?php

namespace Apps\LumenApi\App\Exceptions;

use App\Auth\User\Domain\AuthenticationException;
use App\Auth\User\Domain\UserAlreadyRegistered;
use App\Domain\User\UserNotFound;
use App\Shared\Domain\NotFoundException;
use App\Shared\Domain\ValueObject\NotValidValueObjectException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $e)
    {
        $errors['code'] = $e->getCode();
        $errors['line'] = $e->getLine();
        $errors['file'] = $e->getFile();
        $errors['exception'] = (string)$e;

        return new JsonResponse($errors, Response::HTTP_INTERNAL_SERVER_ERROR);


        $errors['errors'] = null;

        if (true === config('app.debug')) {
            $errors['code'] = $e->getCode();
            $errors['line'] = $e->getLine();
            $errors['file'] = $e->getFile();
            $errors['exception'] = (string)$e;
        }

        return $this->handleException($e, $errors);
    }

    private function handleException(Throwable $e, array $errors = []): JsonResponse
    {
        $errors['errors'] = $e->getPrevious()->getMessage();

        if ($e->getPrevious() instanceof UserNotFound) {
            return new JsonResponse($errors, Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof ValidationException) {
            return new JsonResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof InvalidArgumentException) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return new JsonResponse($errors, Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($e instanceof HttpException) {
            return new JsonResponse($errors, $e->getStatusCode());
        }

        return new JsonResponse($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
