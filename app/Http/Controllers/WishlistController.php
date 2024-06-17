<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Wishlist;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
public function update_Wishlist($product_id)
    {
    // Asumsikan customer id = 1
        $customer_id = 1;
     //   $userId = Auth::id();

    // Cek produk ada di wishlist customer atau belum
    $exists = DB::table('wishlist')->where('product_id', $product_id)
                ->where('customer_id', $customer_id)->exists();

    if ($exists) {
            // kalau product belum ada, bakal ditambahkan
            DB::table('wishlist')->where('product_id', $product_id)
                ->where('customer_id', $customer_id)->delete();
    } else {
     // kalo ada, wishlist akan terhapus
            DB::table('wishlist')->where('product_id', $product_id)
            ->where('customer_id', $customer_id)->delete();
            DB::table('wishlist')->insert(['product_id' => $product_id, 'customer_id' => $customer_id,]);
    }

   //redirect ke home setelah mengupdate wishlist
    return redirect()->route('home');
    }

public function showWishlist()
    {
        // ambil semua wishlist dari kolom wishlist
        $wishlists = Wishlist::all();

        return view('wishlist.index', compact('wishlists'));
    }
}
