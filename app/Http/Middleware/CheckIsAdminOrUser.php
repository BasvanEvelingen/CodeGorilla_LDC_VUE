<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 *  Class for checking if user is an authenticated user that being either
 *  an common user or an administrator
 */
class CheckIsAdminOrUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (
            Auth::user()->role === 1 || Auth::user()->role === 2) {
            return $next($request);
        } else {
            return response()->json(['error' => 'Niet bevoegd'], 403);
        }
    }
}
