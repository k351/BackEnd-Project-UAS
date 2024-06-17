<?php

namespace App\Http\Controllers;

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
    public function updateQuantity(Request $request, $id)
    {
        // Find the product
        $product = Product::find($id);

        if ($product) {
            // Adjust stock
            if ($request->operation === 'increase') {
                $product->stock++;
            } elseif ($request->operation === 'decrease' && $product->stock > 1) {
                $product->stock--;
            }

            // Save updated product
            $product->save();
        }

        // Redirect back with updated quantities
        return back();
    }

    public function store(Request $request) {

    }
}
