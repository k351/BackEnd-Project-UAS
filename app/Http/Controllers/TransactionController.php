<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index($id)
    {
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
        $seller = $product->shop->seller;

        if ($user->id === $seller->id) {
            return redirect()->route('transaction.confirm', ['id' => $id])
                ->with('error', 'Tidak bisa membeli produk sendiri.');
        }

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

    public function checkout()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->get();
        return view('transaction.checkout', [
            'cart' => $cart,
        ]);
    }

    public function create(Request $request)
    {
        $productIds = $request->input('product_ids');
        $user = Auth::user();

        $totalAmount = 0;
        $sellerEarnings = [];

        foreach ($productIds as $id) {
            $product = Product::findOrFail($id);
            $cart = Cart::where('user_id', $user->id)
                ->where('product_id', $id)
                ->where('status', 1)
                ->firstOrFail();

            $amount = $product->price * $cart->quantity;
            $totalAmount += $amount; // 3000 biaya tetap per produk

            $seller = $product->shop->seller;

            if ($user->id === $seller->id) {
                return redirect()->route('transaction.confirm', ['id' => $id])
                    ->with('error', 'Tidak bisa membeli produk sendiri.');
            }
            if ($user->wallet_balance < $totalAmount + 3000) {
                return redirect()->route('transaction.checkout', ['id' => $id])
                    ->with('error', 'Saldo tidak mencukupi untuk melakukan transaksi ini.');
            }
            if ($cart->quantity > $product->stock) {
                return redirect()->route('transaction.index', ['id' => $id])
                    ->with('error', 'Stock produk tidak tersedia');
            }

            $product->stock -= $cart->quantity;
            $product->save();

            $seller = $product->shop->seller;
            if ($seller) {
                $sellerEarnings[$seller->id] = ($sellerEarnings[$seller->id] ?? 0) + $amount;
            }
        }

        $user = User::find($user->id);
        $user->wallet_balance -= ($totalAmount + 3000);
        $user->save();

        foreach ($sellerEarnings as $sellerId => $earning) {
            $seller = User::findOrFail($sellerId);
            $seller->wallet_balance += $earning;
            $seller->save();
        }

        $transaction = Transaction::create([
            'customer_id' => $user->id,
            'total' => $totalAmount + 3000,
        ]);

        foreach ($productIds as $id) {
            $product = Product::findorfail($id);

            $cart = Cart::where('user_id', $user->id)
                ->where('product_id', $id)
                ->where('status', 1)
                ->firstOrFail();

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $id,
                'price' => $product->price,
                'quantity' => $cart->quantity,
            ]);

            $cart->delete();
        }

        return redirect()->route('home');
    }

    public function history()
    {
        $user = Auth::user();

        if(!$user){
            return redirect()->route('login');
        }

        $transactions = Transaction::orderByDesc('created_at')->where('customer_id', $user->id)->get();
    
        return view('transaction.history', [
            'transactions' => $transactions,
        ]);
    }
    

}
