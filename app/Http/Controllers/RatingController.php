<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rate($transaction_id, $product_id) {
        return view('rating', compact('transaction_id', 'product_id'));
    }

    
    public function postRate(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required'|'integer',
            'product_id' => 'required'|'integer',
            'rating' => 'required'|'integer'|'between:1,5',
            'review' => 'sometimes'|'string'|'max:1000',
        ]);
        $user = Auth::user();
        Rating::create([
            'product_id' => $request->product_id,
            'customer_id' => $user->id,
            'transaction_id' => $request->transaction_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);
        return route('home');
    }
}
