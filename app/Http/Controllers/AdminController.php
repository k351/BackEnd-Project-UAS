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
        $totalUsers = User::where('type', '!=', 'admin')->count();
        $totalSellers = User::where('type', 'seller')->count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $users = User::where('type', '!=', 'admin')->paginate(5);

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

    public function searchUsers(Request $request)
    {
        $search = $request->search;
        $search = Str::lower($search);
        $users = User::whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->where('type', '!=', 'admin')
                    ->paginate(5);
        $totalUsers = User::where('type', '!=', 'admin')->count();
        $totalSellers = User::where('type', 'seller')->count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();

        return view('admin.index', compact('users', 'totalUsers', 'totalSellers', 'totalCategories', 'totalProducts'));
    }

    public function take_action($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->withErrors(['error' => 'theres no user with provided id']);
        }
        if($user->status !== "none"){
            return redirect()->back()->withErrors(['error' => 'user already been banned/timeout']);
        }
        return view('admin.take_action', compact('user'));
    }

    public function timeout_ban(Request $request, $id){
        $request->validate([
            'reason' => 'required|min:5|max:1000',
            'action' => 'required|in:timeout,banned'
        ]);
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->withErrors(['error' => 'theres no user with provided id']);
        }
        if($user->status !== "none"){
            return redirect()->back()->withErrors(['error' => 'user already been banned/timeout']);
        }
        $user->status=$request->action;
        $user->reason=$request->reason;
        $user->save();
        return redirect()->route('admin.dashboard');
    }

    public function remove_action($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->withErrors(['error' => 'theres no user with provided id']);
        }
        if($user->status === "none"){
            return redirect()->back()->withErrors(['error' => 'user has not been banned/timeout']);
        }
        return view('admin.remove_action', compact('user'));
    }

    public function untimeout_unban($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->withErrors(['error' => 'theres no user with provided id']);
        }
        if($user->status === "none"){
            return redirect()->back()->withErrors(['error' => 'user has not been banned/timeout']);
        }
        $user->status="none";
        $user->reason="-";
        $user->save();
        return redirect()->route('admin.dashboard');
    }
}
