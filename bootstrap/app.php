<?php

use BezhanSalleh\FilamentExceptions\Facades\FilamentExceptions;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web([
            App\Http\Middleware\AddSeoDefaults::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(
            fn (Throwable $e) => $exceptions->handler->shouldReport($e) &&
                FilamentExceptions::report($e)
        );
    })->create();
