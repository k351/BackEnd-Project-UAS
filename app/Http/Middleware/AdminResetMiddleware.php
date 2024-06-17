<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminResetMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->validate([
            'email' => 'required|email',
            'secretkey' => 'sometimes|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return  redirect()->back()->withErrors(['email' => 'User is not registered']);
        }

        if($user->type !== 'admin' && $request->secretkey){
            return redirect()->route('password.request')->withErrors(['email' => 'User is not an admin']);
        }

        if($user && $user->type === 'admin' && !$request->secretkey){
            return redirect()->route('password.request.admin')->with('email', $request->email);
        }

        if($user && $user->type === 'admin' && $request->secretkey !== env('SECRET_KEY')){
            return redirect()->back()->with('email', $request->email)->withErrors(['secretkey' => 'Wrong Secret Key']);
        }
        
        return $next($request);
    }
}
