<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckUserStatusMiddleware
{
    public function handle($request, Closure $next)
    {

        if (app('auth')->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (app('auth')->user()->admins_status) {
            return $next($request);
        }
        app('auth')->logout();
        return redirect()->route('admin.auth.getLogin');
    }
}
