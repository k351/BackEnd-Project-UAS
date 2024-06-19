<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
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
            return redirect()->route('transaction.index', ['id' => $id])
            ->with('error', 'Stock produk tidak tersedia');
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

        $request->session()->put('cart_id', $cartItem->id);

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

    public function create($id)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)
                    ->where('product_id', $id)
                    ->firstOrFail();

        $product = Product::findOrFail($id);
        $totalAmount = ($product->price * $cart->quantity) + 3000;

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
            $sellerEarning = $totalAmount - 3000;

            $seller->wallet_balance += $sellerEarning;
            $seller->save();
        }

        $transaction = Transaction::create([
            'customer_id' => $user->id,
            'total' => $totalAmount,
        ]);

        $transactionItems = TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id'=> $id,
            'price' => $transaction->total,
            'quantity' => $cart->quantity,
        ]);

        $cart->delete();

        return redirect()->route('home');
    }
}
