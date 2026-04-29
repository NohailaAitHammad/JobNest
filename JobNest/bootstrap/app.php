<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
                'is.admin'     => \App\Http\Middleware\IsAdmin::class,
                'is.candidat'  => \App\Http\Middleware\IsCandidat::class,
                'is.recruteur' => \App\Http\Middleware\IsRecruteur::class
            ]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Non authentifié.',
                ], 401);
            }
            return redirect()->route('show.login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        });

        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ressource introuvable',
                ], 404);
            }
            return redirect()->route('home')->with('error', 'Désolé, la ressource demandée est introuvable.');
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validation',
                    'errors' => $e->errors(),
                ], 422);
            }
            throw $e;
        });
    })->create();
