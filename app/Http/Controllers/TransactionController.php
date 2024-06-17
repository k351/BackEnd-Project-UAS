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

    public function store(Request $request) {

    }
}
