<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
public function update_Wishlist($product_id)
    {
    // Asumsikan customer id = 1
        $customer_id = 1;

    // Cek produk ada di wishlist customer atau belum
    $exists = DB::table('wishlist')->where('product_id', $product_id)
                ->where('customer_id', $customer_id)->exists();

    if ($exists) {
     // kalau product belum ada, bakal ditambahkan
            DB::table('wishlist')->insert(['product_id' => $product_id, 'customer_id' => $customer_id,]);
    } else {
     // kalo ada , wishlist akan terhapus
            DB::table('wishlist')->where('product_id', $product_id)
            ->where('customer_id', $customer_id)->delete();
    }

   //redirect ke home setelah mengupdate wishlist
    return redirect()->route('home');
    }
}
