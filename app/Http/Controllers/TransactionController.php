<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index($id) {
        $product = Product::find($id);

        return view("transaction.index", [
            'product' => $product,
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

    public function create(Request $request, $id)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)
                    ->where('product_id', $id)
                    ->firstOrFail();

        $product = Product::findOrFail($id);
        $totalAmount = ($product->price * $cart->quantity) + 3000; // Calculate the total amount

        if ($user->wallet_balance < $totalAmount) {
            return redirect()->route('transaction.checkout', ['id' => $id])
                ->with('error', 'Saldo tidak mencukupi untuk melakukan transaksi ini.');
        }

        $product->stock -= $cart->quantity;
        $product->save();

        $user->wallet_balance -= $totalAmount;
        $user->save();

        $seller = $product->shop->seller;

        if ($seller) {
            // Calculate seller's earning (example: minus service fees)
            $sellerEarning = $totalAmount - 3000; // Assuming fees are deducted from the total amount

            // Update seller's wallet balance
            $seller->wallet_balance += $sellerEarning;
            $seller->save();
        }

        $transaction = Transaction::create([
            'customer_id' => $user->id,
            'total' => $totalAmount,
        ]);

        $cart->delete();

        return redirect()->route('home');
    }
}
