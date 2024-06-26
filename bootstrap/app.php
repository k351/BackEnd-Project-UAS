<?php

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
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'prevent' => \App\Http\Middleware\PreventBackHistory::class,
            'seller' => \App\Http\Middleware\Seller::class,
            'repass' => \App\Http\Middleware\AdminResetMiddleware::class,
            'rating' => \App\Http\Middleware\RatingMiddleware::class,
            'product' => \App\Http\Middleware\DeleteProductMiddleware::class,
            'check' => \App\Http\Middleware\CheckUserStatus::class,
            'topup' => \App\Http\Middleware\TopUpMiddleware::class,
            'report' => \App\Http\Middleware\ReportMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
