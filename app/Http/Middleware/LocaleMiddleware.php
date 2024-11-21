<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Config;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        if (session()->has('language')) {
            App::setLocale(session()->get('language'));
        }
        return $next($request);
    }
}
