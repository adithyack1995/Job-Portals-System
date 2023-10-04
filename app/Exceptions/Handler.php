<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (Exception $exception, $request) {
            if ($request->wantsJson()) {
                // if ($exception instanceof QueryException) {
                //     return ResponseHelper::errorWithMessageAndStatus(__('exception.databaseError'), Response::HTTP_INTERNAL_SERVER_ERROR);
                // }

                // if ($exception instanceof AuthorizationException) {
                //     return ResponseHelper::errorWithMessageAndStatus(__('exception.noPermission'), Response::HTTP_UNAUTHORIZED);
                // }

                // if (method_exists($exception, 'getStatusCode')) {
                //     return ResponseHelper::errorWithMessageAndStatus($exception->getMessage(), $exception->getStatusCode());
                // }

                // if ($exception instanceof AuthenticationException) {
                //     return ResponseHelper::errorWithMessageAndStatus(__('exception.Unauthenticated'), Response::HTTP_UNAUTHORIZED);
                // }
            }
        });
    }
}
