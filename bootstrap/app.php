<?php

use App\Http\Middleware\ProcessPendingInvitation;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            ProcessPendingInvitation::class,
            TrustProxies::class

        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
