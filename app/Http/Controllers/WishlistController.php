<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //user 1
    public function update_Wishlist($product_id)
    {
        // insert wishlist
        DB::table('wishlist')->insert([
            'product_id' => $product_id,
            'customer_id' => 1,
        ]);
        //delete wishlist (wip)
        return redirect()->route('home');

    }
}
