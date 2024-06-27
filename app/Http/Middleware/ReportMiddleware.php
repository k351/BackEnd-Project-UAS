<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ReportMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $seller = Auth::user();
        $user = User::find($request->id);
        $rating = Rating::find($request->rating_id);
        if(!$user){
            return redirect()->back();
        }
        if(!$rating){
            return redirect()->back();
        }
        if($user->id !== $rating->customer_id){
            return redirect()->back();
        }
        if($rating->report){
            return redirect()->back();
        }
        return $next($request);
    }
}
