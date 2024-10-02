<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckIfDriver;
use App\Http\Middleware\CheckDriverTrip;
use App\Http\Middleware\CheckDriverTripToday;
use App\Http\Middleware\VerifyScan;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //

        $middleware->alias([
            // 'redirectIfDriver' => RedirectIfDriver::class,
            'checkIfDriver' => CheckIfDriver::class,
            'checkDriverTrip' => CheckDriverTrip::class,
            'verifyScan' => VerifyScan::class,
            'checkDriverTripToday' => CheckDriverTripToday::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
