<?php

use App\Infrastructure\Http\Middleware\LoadUserRelations;
use App\Domain\Exceptions\DomainException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'load.user' => LoadUserRelations::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (DomainException $e, Request $request) {

            if ($request->expectsJson()) return response()->json(['message' => $e->getMessage()], $e->getStatusCode());

            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'message' => $e->getMessage(),
                    'type' => 'error'
                ]);
        });
    })->create();
