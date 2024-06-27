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
        //mengecek adakah user yang menjadi target report
        if(!$user){
            return redirect()->back();
        }
        //mengecek ada tidaknya rating
        if(!$rating){
            return redirect()->back();
        }
        //mengecek apakah rating dilakukan oleh user yang sama
        if($user->id !== $rating->customer_id){
            return redirect()->back();
        }
        //mengecek pelaku report adalah seller
        if($seller->type !== 'seller'){
            return redirect()->back();
        }
        //mengecek apakah produk yang dirating milik seller
        $product = $seller->shop->products->where('id', $rating->product_id)->first();
        if(!$product){
            return redirect()->back();
        }
        //mengecek apakah rating telah pernah di report
        if($rating->report){
            return redirect()->back();
        }
        
        return $next($request);
    }
}
