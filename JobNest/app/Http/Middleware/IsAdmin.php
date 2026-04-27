<?php

namespace App\Http\Middleware;

use App\Enums\RoleUser;
use App\Enums\StatusUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role->role !== RoleUser::admin) {
            return back()->with('error', "Unauthorized role");
        }
        return $next($request);
    }
}
