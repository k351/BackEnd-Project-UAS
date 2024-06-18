<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
    //

    public function index()
    {
        // Mengambil produk yang direkomendasikan (contoh sederhana)
        $recommendedProducts = Product::inRandomOrder()->limit(10)->get();
        $wishlist = DB::table('wishlist')
            ->select('id', 'product_id')
            ->where('customer_id', 1)
            ->get()->toArray();

        return view('recomendations.index', compact('recommendedProducts', 'wishlist'));
    }
}
