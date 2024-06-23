<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request)
    {
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

    public function delete($cartId)
    {
        $cartItem = Cart::find($cartId);
        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Cart item not found.');
        }
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function checkout(Request $request)
    {

        $request->validate([
            'selectedItems' => 'required|string',

        ]);
        // Proses Checkout
        $user = auth()->user();
        $selectedItems = $request->input('selectedItems');
        $selected_items = json_decode($selectedItems);
        foreach ($selected_items as $cartItemId) {
            // Misalnya, Anda ingin menandai item di keranjang sebagai sudah dibeli
            $cartItem = Cart::where('id', $cartItemId)->where('user_id', $user->id)->first();
            if ($cartItem) {
                $cartItem->status = 1;
                $cartItem->save();
            }
        }
        return redirect()->route('transaction.checkout')->with('success', 'Checkout completed.');
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');
        // Simpan item ke dalam cart
        $cartItem = new Cart();
        $cartItem->user_id = $user->id;
        $cartItem->product_id = $productId;
        $cartItem->save();
        return redirect()->route('cart.index')->with('success', 'Item added to cart');
    }


    public function showCart()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function deleteCartItem($cartId)
    {
        $cartItem = Cart::find($cartId);
        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Cart item not found.');
        }
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
