<?php

namespace App\Http\Middleware;

use Closure;

class AbortIfHasNoPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!optional($request->user())->can($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
