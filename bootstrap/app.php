<?php

use App\Models\MyResult;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn ($request, \Throwable $e): bool => $request->is('api/*') || $request->expectsJson(),
        );

        $exceptions->renderable(function (ValidationException $e, $request) {
            if (! $request->is('api/*')) {
                return null;
            }

            return MyResult::error(
                $e->getMessage(),
                $e->status,
                $e->errors(),
            );
        });
    })->create();
