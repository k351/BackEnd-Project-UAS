<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->isTimedOut()) {
            if($user->action_time > Carbon::now()->subYear()){
                return redirect()->route('status');
            }
            return redirect()->route('untimeout');
        }
        if ($user && $user->isBanned()) {
            return redirect()->route('status');
        }
        return $next($request);
    }
}