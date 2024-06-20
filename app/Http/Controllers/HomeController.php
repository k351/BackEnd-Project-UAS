<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $product = Product::paginate(8);
        if (Auth::check()) {
            $wishlist = DB::table('wishlist')
                ->select('id', 'product_id')
                ->where('customer_id', Auth::user()->id)
                ->get()
                ->toArray();
        } else {
            $wishlist = [];
        }
        return view('home.index',compact('product','wishlist'));
    }

    public function login_home(){
        $product = Product::all();
        $wishlist = DB::table('wishlist')
            ->select('id', 'product_id')
            ->where('customer_id', 1)
            ->get()
            ->toArray();
        return view('home.index', compact('product', 'wishlist'));
    }

    public function index(){
        return view('admin.index');
    }

    public function product_details($id){
        $data = Product::find($id);
        return view('home.product_details', compact('data'));
    }

    public function wallet_topup($id){
        $user = User::find($id);
        return view('home.wallet_topup', compact('user'));
    }

    public function topping_up($id, Request $request){
        $user = User::find($id);
        $current = $user->wallet_balance;
        $after = $current + $request->quantity;
        $user->wallet_balance=$after;
        $user->save();
        return redirect()->route('home');
    }

    public function shop_page(){
        $product = Product::paginate(20);
        if (Auth::check()) {
            $wishlist = DB::table('wishlist')
                ->select('id', 'product_id')
                ->where('customer_id', Auth::user()->id)
                ->get()
                ->toArray();
        } else {
            $wishlist = [];
        }
        return view('home.shop_page',compact('product', 'wishlist'));
    }

    public function product_search(Request $request){
        $search = $request->search;
        $search = Str::lower($search);
        $product = Product::whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])->paginate(20);
        $wishlist = DB::table('wishlist')
                ->select('id','product_id')
                ->where('customer_id', 1)
                ->get()-> toArray();
        return view('home.shop_page',compact('product', 'wishlist'));
    }

    public function status()
    {
        $user = Auth::user();

        return view('auth.status');
    }
    
    public function untimeout(){
        $user = Auth::user();
        if(!$user){
            return redirect()->route('login');
        }
        if(!($user->isTimedOut())){
            return redirect()->back();
        }
        $user->status="none";
        $user->reason="-";
        $user->action_time = null;
        $user->save();
        return redirect()->route('home');
    }
}
