<?php

namespace App\Http\Middleware;

use Closure;

class HandleLanguage
{
    public function handle($request, Closure $next)
    {
        app()->setLocale(@request()->getPreferredLanguage() ?? 'en');
        return $next($request);
    }
}
