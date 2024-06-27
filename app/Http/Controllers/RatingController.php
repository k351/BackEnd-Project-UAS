<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rate($transaction_id, $product_id) {
        //mengembalikan view rating
        return view('rating', compact('transaction_id', 'product_id'));
    }

    
    public function postRate(Request $request, $transaction_id, $product_id)
    {
        //mengvalidasi rating dan review yang tela dilakukan
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string|between:5,200',
        ]);
        //mengecek apakah review ada dan bila tidak maka akan memberikan nilai null
        $review = $request->review ?? null;
        $user = Auth::user();
        //menginsert rating ke tabel ratings
        Rating::create([
            'product_id' => $product_id,
            'customer_id' => $user->id,
            'review' => $review,
            'transaction_id' => $transaction_id,
            'rating' => $request->rating,
        ]);
        //mengembalikan user ke transaction history
        return redirect()->route('transaction.history');
    }
}
