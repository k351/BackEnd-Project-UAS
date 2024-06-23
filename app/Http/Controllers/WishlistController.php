<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function show_wishlist()
    {
        // ambil semua wishlist dari kolom wishlist
        $wishlists = DB::table('wishlist') //membuta query builder untuk mengambil data dari tabel wishlist
            ->orderBy('wishlist.product_id', 'asc')->join('products', 'products.id', "=", "wishlist.product_id") // diurutin hasil query ascending
            ->select('wishlist.*', 'products.name as product_name', 'products.price as product_price') //memilih kolom name pd tabel product
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
            DB::table('wishlist')
                ->where('product_id', $product_id) // True
                ->where('customer_id', $user->id)->delete();
        } else {
            // kalau ga ada ditambahkan
            DB::table('wishlist')
                ->insert(['product_id' => $product_id, 'customer_id' => $user->id,]); //false
        }
        $exists = DB::table('wishlist')
            ->orderBy('wishlist.product_id', 'asc')
            ->join('products', 'products.id', "=", "wishlist.product_id")
            ->select('wishlist.*', 'products.name as product_name', 'products.price as product_price')
            ->get(); // copas diatas show_wishllist

        //redirect ke back setelah mengupdate wishlist
        return redirect()->back();
    }

    public function delete_Wishlist($id)
    {
        DB::table('wishlist')->whereId($id)
            ->delete();
        return redirect()->route('wishlist');
    }
    public function WishlistToCart(Request $request)
    {
        $user = Auth::user();
        $wishlistId = $request->input('wishlist_id');

        // Cari item wishlist berdasarkan ID
        $wishlistItem = DB::table('wishlist')->find($wishlistId);
        if (!$wishlistItem) {
            return redirect()->back()->with('error', 'Item not found in wishlist.');
        }

        // Tambahkan item dari wishlist ke cart
        $cartItem = new Cart();
        $cartItem->user_id = $user->id;
        $cartItem->product_id = $wishlistItem->product_id;
        $cartItem->quantity = 1; // Misalnya, set jumlah ke 1
        $cartItem->save();

        // Hapus item dari wishlist setelah ditambahkan ke cart
        DB::table('wishlist')->where('id', $wishlistId)->delete();
        return redirect()->route('wishlist')->with('success', 'Item moved to cart.');
    }


}

