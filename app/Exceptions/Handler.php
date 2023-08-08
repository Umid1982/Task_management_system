<?php

namespace App\Exceptions;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
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
    }

    public function render($request, Throwable $e): Application|Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|\Symfony\Component\HttpFoundation\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $response = parent::render($request, $e);

        if ($response->getStatusCode() >= 400) {
            return response([
                'message' => $e->getMessage(),
                'success' => false
            ]);
        }

        return $response;
    }
}
