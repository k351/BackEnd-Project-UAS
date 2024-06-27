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

    
    public function postRate(Request $request, $transaction_id, $product_id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string'
        ]);
        $review = $request->review ?? null;
        $user = Auth::user();
        Rating::create([
            'product_id' => $product_id,
            'customer_id' => $user->id,
            'review' => $review,
            'transaction_id' => $transaction_id,
            'rating' => $request->rating,
        ]);
        return redirect()->route('transaction.history');
    }
}
