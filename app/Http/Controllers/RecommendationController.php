<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Requests;

class RecommendationController extends Controller
{
    public function index()
    {
        // Mengambil produk yang direkomendasikan (contoh sederhana)
        $recommendedProducts = Product::inRandomOrder()->limit(10)->get();

        return view('recommendations.index', compact('recommendedProducts'));
    }
}