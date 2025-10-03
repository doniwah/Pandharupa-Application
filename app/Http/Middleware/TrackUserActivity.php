<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TrackUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Set user sebagai online selama 5 menit
            Cache::put('user-online-' . Auth::id(), true, now()->addMinutes(5));
        }

        return $next($request);
    }
}