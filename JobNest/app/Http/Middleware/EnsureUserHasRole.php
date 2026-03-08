<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $roleId  = Role::where('role', $role)->first();
        if($request->user()->role_id === $roleId->id){
            return $next($request);
        }
        return abort(403, 'Access non authorise');

        return $next($request);
    }
}
