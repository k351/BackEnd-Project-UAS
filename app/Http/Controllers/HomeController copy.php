<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Product;

use App\Models\Wishlist;

class HomeController extends Controller
{
    public function home()
    {
        $product = Product::paginate(8);
        if (Auth::id()) {
            $user = Auth::user();
            $userId = $user->id;
            $count = Cart::where('user_id', $userId)->count();

            $wishlist = DB::table('wishlist')
                ->select('id', 'product_id')
                ->where('customer_id', 1)
                ->get()->toArray();
        } else {
            $count = '';
        }

        return view('home.index', compact('product', 'wishlist' . 'count'));
        redirect()->back();
    }

    public function login_home()
    {

        $product = Product::all();
        $user = Auth::user();
        $userId = $user->id;
        $count = Cart::where('user_id', $userId)->count();

        return view('home.index', compact('product', 'count'));
    }

    public function index()
    {
        return view('admin.index');
    }

    public function product_details($id)
    {
        $data = Product::find($id);

        if (Auth::id()) {
            $user = Auth::user();
            $userId = $user->id;
            $count = Cart::where('user_id', $userId)->count();

            $wishlist = DB::table('wishlist')
                ->select('id', 'product_id')
                ->where('customer_id', 1)
                ->get()->toArray();
        } else {
            $count = '';
        }

        return view('home.product_details', compact('data','wishlist','count'));
    }

    public function shop_page()
    {
        $product = Product::paginate(20);
        if (Auth::id()) {
            $user = Auth::user();
            $userId = $user->id;
            $count = Cart::where('user_id', $userId)->count();

            $wishlist = DB::table('wishlist')
                ->select('id', 'product_id')
                ->where('customer_id', 1)
                ->get()->toArray();
        } else {
            $count = '';
            $wishlist = [];
        }
        return view('home.shop_page', compact('product', 'wishlist'));
    }

    public function product_search(Request $request)
    {
        $search = $request->search;
        $search = Str::lower($search);
        $product = Product::whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])->paginate(20);
        $wishlist = DB::table('wishlist')
            ->select('id', 'product_id')
            ->where('customer_id', 1)
            ->get()->toArray();
        return view('home.shopF_page', compact('product', 'wishlist'));
    }

    // buat cart
    public function add_cart($id)
    {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart;
        $data->user_id =  $user_id;
        $data->product_id = $user_id;
        $data->save();

        //  toastr()->timeOut(10000)->closeButton()->addSuccess('Product Added to Cart Successfully');
        return redirect()->back();
    }
}
