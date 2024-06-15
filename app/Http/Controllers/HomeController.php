<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $product = Product::all();
        return view('home.index',compact('product'));
    }

    public function index(){
        return view('admin.index');
    }
}