<?php

namespace App\Exceptions;

use App\Traits\Response\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /* Render an exception into an HTTP response.
    *
    * @param  Request request
    * @param  Throwable  $exception
    * @return Response
    * @throws Throwable
    */
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            return match (get_class($exception)) {
                MethodNotAllowedHttpException::class => $this->errorResponse(
                    ['error' => [__('api.method_not_allowed')]],
                    $exception->getStatusCode()
                ),

                NotFoundHttpException::class => $this->errorResponse(
                    ['error' => [__('api.not_found')]],
                    $exception->getStatusCode()
                ),
                ModelNotFoundException ::class => $this->errorResponse(
                    ['error' => [__('api.record_not_found')]],
                    404
                ),

                ValidationException::class => $this->errorResponse(
                    $exception->errors(),
                    $exception->status,
                ),

                Exception::class => $this->errorResponse(
                    ['error' => [$exception->getMessage()]],
                    $exception->getCode()
                ),

                default => $this->errorResponse()
            };
        }

        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
