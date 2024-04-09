<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Artisan;

class ClearCache
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        Artisan::call('cache:clear');
        return $response;
    }
}
