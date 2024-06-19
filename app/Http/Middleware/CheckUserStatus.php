<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && ($user->isBanned() || $user->isTimedOut())) {
            return redirect()->route('status');
        }

        return $next($request);
    }
}