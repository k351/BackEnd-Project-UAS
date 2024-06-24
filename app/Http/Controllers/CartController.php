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
        $cartItems = Cart::where('user_id', $user->id)->whereIn('status', [0, 1])->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $cartUpdates = $request->input('cart');
        foreach ($cartUpdates as $items_id => $quantity) {
            $cartItem = Cart::where('user_id', $user->id)->where('id', $items_id)->first();
            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        $cartUpdates = $request->input('selectedItems');
        //dd($cartUpdates);
        foreach ($cartUpdates as $items_id => $status) {
            $cartItem = Cart::where('user_id', $user->id)->where('id', $items_id)->first();
            if ($cartItem) {
                if ($status == 0) {
                    $cartItem->status = 0;
                } else {
                    $cartItem->status = 1;
                }
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
        // Process Checkout
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->whereIn('status', [1])->get();

        if ($cart->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors('Please select a product to checkout.')
                ->withInput();
        }

        return redirect()->route('transaction.checkout')->with('success', 'Checkoutcompleted.');
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
