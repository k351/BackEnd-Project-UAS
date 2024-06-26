<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->route('id');
        $authenticatedUser = Auth::user();

        if ($authenticatedUser->id != $userId) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }

        return $next($request);
    }
}
