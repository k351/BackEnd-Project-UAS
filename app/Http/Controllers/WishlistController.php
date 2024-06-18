<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function show_wishlist()
    {
        // ambil semua wishlist dari kolom wishlist
        $wishlists = DB::table('wishlist')->orderBy('wishlist.product_id', 'asc')->join('products', 'products.id', "=", "wishlist.product_id")
            ->select('wishlist.*', 'products.name as product_name', 'products.price as product_price')
            ->get();
        return view('wishlist.index', compact('wishlists'));
    }


    public function update_Wishlist($product_id)
    {   
        $user = Auth::user();

        // Cek produk ada di wishlist customer atau belum
        $exists = DB::table('wishlist')->where('product_id', $product_id)
            ->where('customer_id', $user->id)->exists();

        if ($exists) {
            // kalau product ada, bakal didelete
            DB::table('wishlist')->where('product_id', $product_id)
                ->where('customer_id', $user->id)->delete();
        } else {
            // kalau ga ada ditambahkan
            DB::table('wishlist')->insert(['product_id' => $product_id, 'customer_id' => $user->id,]);
        }
        $exists = DB::table('wishlist')->orderBy('wishlist.product_id', 'asc')->join('products', 'products.id', "=", "wishlist.product_id")
            ->select('wishlist.*', 'products.name as product_name', 'products.price as product_price')
            ->get();
        //redirect ke back setelah mengupdate wishlist
        return redirect()->back();
    }

    public function delete_Wishlist($id)
    {
        DB::table('wishlist')->whereId($id)
            ->delete();

        //redirect ke home setelah mengupdate wishlist
        return redirect()->route('wishlist');
    }
}
