<?php

namespace App\Http\Middleware;

use App\Enums\RoleUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsCandidat
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role->role !== RoleUser::candidat) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized Role",
            ], 403);
        }
        return $next($request);
    }
}
