<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckPermissionMiddleware
{
    public function handle($request, Closure $next, $permission=null)
    {
        $name = $request->route()->getName();
        // dd($name) ;
        $excludedRoutes = config('excludedroutes');
        
        if (in_array($name, $excludedRoutes)) {
            return $next($request);
        }
        
        $routeArr = explode('.', $name);
        $module = $routeArr[0];
        $page = $routeArr[1];
        $action = $routeArr[2];
        // dd($action) ;
        // dd($page) ;
        // dd($module) ;
        // dd($name) ;
        switch (true) {
            case in_array($action, ['index', 'show']):
                $permission = 'view '. $page;
                break;
            
            case in_array($action, ['create', 'store']):
                $permission = 'create '. $page;
                break;
            
            case in_array($action, ['edit', 'update']):
                $permission = 'update '. $page;
                break;
            
            case in_array($action, ['destroy']):
                $permission = 'delete '. $page;
                break;
            
            default:
                $permission = $action .' '. $page;
                break;
        }
        // dd($permission) ;
        if (app('auth')->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (app('auth')->user()->can($permission)) {
            return $next($request);
        }

        throw UnauthorizedException::forPermissions([$permission]);
    }
}
