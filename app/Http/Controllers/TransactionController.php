<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index($id) {
        $data = Product::find($id);

        return view("transaction.index", [
            'product' => $data,
        ]);
    }

    public function confirm(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($id);

        if ($validated['quantity'] > $product->stock) {
            return back()->withErrors([
                'quantity' => 'Jumlah yang diminta melebihi stok yang tersedia.',
            ])->withInput();
        }

        $user = auth()->user();

        $cartItem = Cart::updateOrCreate(
            [
                'product_id' => $id,
                'user_id' => $user->id,
            ],
            [
                'quantity' => $validated['quantity'],
            ]
        );

        return redirect()->route('transaction.checkout', ['id' => $id]);
    }

    public function checkout(Request $request, $id) {
        $user = auth()->user();
        $product = Product::findOrFail($id);
        $cart = Cart::where('user_id', $user->id) ->where('product_id', $id)->firstOrFail();

        return view('transaction.checkout', [
            'product' => $product,
            'cart' => $cart,
        ]);
    }
}
