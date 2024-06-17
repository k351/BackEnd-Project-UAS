<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DeleteProductMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $product = Product::find($request->route('id'));

        if(!$product){
            return redirect()->back()->withErrors(['error' => 'Product not Found']);
        }

        $shop = Shop::where('seller_id', Auth::user()->id)->first();
        if ($shop->id !== $product->shop_id) {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to edit/delete this product.']);
        }

        return $next($request);
    }
}
