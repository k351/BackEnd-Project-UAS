<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Rating;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RatingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $product_id = $request->product_id;
        $transaction_id = $request->transaction_id;


        if (!$user) {
            return redirect('/login');
        }

        $history = Transaction::where('id', $transaction_id)->where('customer_id', $user->id)->first();

        if (!$history) {
            return redirect()->back();
        }

        $product = $history->transactionitems->where('product_id', $product_id)->first();  

        if(!$product){
            return redirect()->back();
        }

        $reviewed = Rating::where('customer_id', $user->id)
            ->where('product_id', $product_id)
            ->where('transaction_id', $transaction_id)
            ->first();
                                                
        if ($reviewed) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
