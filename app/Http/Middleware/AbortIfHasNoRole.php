<?php

namespace App\Http\Middleware;

use Closure;

class AbortIfHasNoRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if (!optional(request()->user())->hasRole($role)) {
            abort(404);
        }

        if (isset($permission) && !$request->user()->can($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
