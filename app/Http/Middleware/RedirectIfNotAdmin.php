<?php
/**
 * Created by PhpStorm.
 * User: faerulsalamun
 * Date: 20/06/18
 * Time: 12.01
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {

        if (!Auth::guard($guard)->check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}