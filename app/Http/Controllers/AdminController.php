<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{

    public function index()
    {
        $totalUsers = User::count();
        $totalSellers = User::where('type', 'seller')->count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $users = User::paginate(5);

        return view('admin.index', compact('users', 'totalUsers', 'totalSellers', 'totalCategories', 'totalProducts'));
    }
    
    public function view_category(){
        $data = Category::paginate(5);

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request){
        $category = new Category;

        $category->category_name = $request->category;

        $category->save();

        session()->flash('toastr', 'Category added successfully');

        return redirect()->back();
    }

    public function delete_category($id)
    {
        $data = Category::find($id);

        $data->delete();

        session()->flash('toastr', 'Category deleted successfully');

        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);

        $data->category_name= $request->category;

        $data->save();

        session()->flash('toastr', 'Category updated successfully');

        return redirect('/view_category');
    }
}
