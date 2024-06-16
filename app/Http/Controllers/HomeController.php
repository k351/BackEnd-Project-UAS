<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Wishlist;

class HomeController extends Controller
{
    public function home()
    {
        $product = Product::all();
            $wishlist = DB::table('wishlist')
                ->select('id','product_id')
                ->where('customer_id', 1)
                ->get()-> toArray();
        return view('home.index',compact('product','wishlist'));
    }

    public function login_home(){
        $product = Product::all();
        return view('home.index',compact('product'));
    }

    public function index(){

        return view('admin.index');
    }
}
