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
        //mengecek apakah user timeout
        if ($user && $user->isTimedOut()) {
            //bila user timeout cek apakah dia sudah melewati satu minggu
            if($user->action_time > Carbon::now()->subWeek()){
                return redirect()->route('status');
            }
            return redirect()->route('untimeout');
        }
        //mengecek apakah user di ban
        if ($user && $user->isBanned()) {
            return redirect()->route('status');
        }
        return $next($request);
    }
}