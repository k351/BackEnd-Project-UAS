<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request) {
        $user = auth()->user();
        $cartUpdates = $request->input('cart');

        foreach ($cartUpdates as $productId => $quantity) {
            $cartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();
            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function delete($cartId) {
        dd($cartId);
        $cart = Cart::where("id", $cartId)->first();

        $cart->delete();

        return redirect()->route('home')->with('success', 'Item removed from cart.');
    }

    public function checkout(Request $request) {
        $user = auth()->user();
        $selectedItems = $request->input('selectedItems', []);

        return redirect()->route('cart.index')->with('success', 'Checkout completed.');
    }

}