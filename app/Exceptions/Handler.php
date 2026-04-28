<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        $response = parent::render($request, $exception);

        if ($request->expectsJson() || $request->is('api/*')) {
            return $response;
        }

        if (in_array($response->getStatusCode(), [404, 500])) {
            return Inertia::render(
                'Error' . $response->getStatusCode(),
                ['status' => $response->getStatusCode()]
            )->toResponse($request)->setStatusCode($response->getStatusCode());
        }

        return $response;
    }
}
