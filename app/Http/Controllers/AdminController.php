<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    public function view_category(){
        $data = Category::all();

        return view('admin.category', compact('data'));
    }
}
