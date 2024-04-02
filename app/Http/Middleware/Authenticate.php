<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use Closure;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

    public function handle($request, Closure $next, ...$guards)
    {
        // dd();
        if (!app(AuthController::class)->attemptLogin($request)) {
            return redirect()->route('login');
        }

        return $next($request);
    }
    // protected function redirectTo(Request $request): ?string
    // {
    //     return app(AuthController::class)->attemptLogin($request) ? $next($request) : route('login');
    // }





}
