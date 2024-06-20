<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
    public function index()
{
    try {
        $recommendedProducts = Product::inRandomOrder()->limit(10)->get();
        if ($recommendedProducts->isEmpty()) {
            return view('recomendations.recomendation', ['message' => 'No recommended products found.']);
        }
        $wishlist = DB::table('wishlist')
            ->select('id', 'product_id')
            ->where('customer_id', 1)
            ->get()->toArray();
        return view('recomendations.recomendation', compact('recommendedProducts', 'wishlist'));
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
