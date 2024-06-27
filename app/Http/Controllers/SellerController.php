<?php
namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Rating;
use App\Models\Report;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function create(): View
    {
        return view('seller.register');
    }

    public function registerSeller(Request $request)
    {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
    ]);

    // Check if the shop name already exists
    $existingShop = Shop::where('shop_name', $request->name)->first();
    if ($existingShop) {
        return redirect()->back()->withErrors(['name' => 'The shop name is already taken. Please choose a different name.']);
    }

    $shops = Shop::create([
        'shop_name' => $request->name,
        'seller_id' => Auth::user()->id,
    ]);

    $user = Auth::user();
    $user->type = 'seller';
    $user->save();

    return redirect()->route('home');
    }

    public function view_dashboard()
    {
        $seller = auth()->user();
        $shop = $seller->shop;

        if ($shop) {

            $products = $shop->products;

            $totalStock = $products->sum('stock');
        } else {
            $products = collect();
            $totalStock = 0;
        }
        return view('seller.index', compact('products', 'totalStock'));
    }

    public function search(Request $request)
{
    // Get the authenticated seller
    $seller = auth()->user();
    $searchTerm = $request->input('search');

    $shop = $seller->shop;

    if ($shop) {
        $products = $shop->products()->where('name', 'ILIKE', '%' . $searchTerm . '%')->get();
        $totalStock = $products->sum('stock');
    } else {
        $products = collect();
        $totalStock = 0;
    }

    return view('seller.index', compact('products', 'totalStock'));
}

public function rating_search(Request $request)
{
    //mencari rating berdasarkan product name
    $shop = Auth::user()->shop;
    $searchTerm = $request->input('search');
    if ($shop) {
        $products = $shop->products()->where('name', 'ILIKE', '%' . $searchTerm . '%')->with('ratings.customer')->get();
    } else {
        $products = [];
    }
    return view('seller.review', compact('products'));
}

    public function view_product()
    {
        $user = Auth::user();
        $shop = $user->shop;

        if (!$shop) {
            return redirect()->back()->withErrors(['error' => 'You do not have a shop.']);
        }

        $data = Product::where('shop_id', $shop->id)->get();
        $category = Category::all();

        return view('seller.product', compact('category', 'data'));
    }

    public function upload_product(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'product_stock' => 'required|integer',
            'product_price' => 'required|numeric',
            'product_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        DB::beginTransaction();
    
        try {
            $user = Auth::user();
            $shop = $user->shop;
            $data = new Product;
    
            $data->name = $request->product_name;
            $data->category_id = $request->category;
            $data->stock = $request->product_stock;
            $data->price = $request->product_price;
            $data->description = $request->product_description;
            $data->shop_id = $shop->id;
            $data->date_added = now();
            $data->created_at = now();
            $data->updated_at = now();
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products'), $imagename);
                $data->image = $imagename;
            }
    
            $data->save();
            DB::commit();
    
            return redirect()->back()->with('toastr', 'Product added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product upload error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'There was an error uploading the product.']);
        }
    }    

    public function delete_product($id){
        $data = Product::find($id);
        $data->delete();
        session()->flash('toastr', 'Product deleted successfully');
        return redirect()->back();
    }

    public function edit_product($id){
        $data = Product::find($id);
        $category = Category::all();
        return view('seller.edit_product', compact('data', 'category'));
    }

    public function update_product(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'product_stock' => 'required|integer',
            'product_price' => 'required|numeric',
            'product_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try{
            $data = Product::find($id);
            $data->name = $request->product_name;
            $data->category_id = $request->category;
            $data->stock = $request->product_stock;
            $data->price = $request->product_price;
            $data->description = $request->product_description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products'), $imagename);

                if ($data->image) {
                    $imagePath = public_path('products/') . $data->image;
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

            $data->image = $imagename;
        }
        $data->save();

        session()->flash('toastr', 'Product updated successfully');
        return redirect()->route('view.product');
    } catch (\Exception $e) {
        Log::error('Product update error: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'There was an error updating the product.']);
        }
    }

    public function get_review(){
    $shop = Auth::user()->shop;
    if ($shop){
        $products = $shop->products()->with('ratings.customer')->get();
    } 
    else{
        $products = [];
    }
    return view('seller.review', compact('products'));
    }

    public function report_user($id, $rating_id){
        //mengembalikan view dengan user yang direport dan rating id yang dilakukan user
        $user = User::find($id);
        return view('seller.report_user', compact('user', 'rating_id'));
    }

    public function give_report(Request $request, $id, $rating_id){
        //mengvalidasi reason agar wajib dan minimal 5 max 1000 kata
        $request->validate([
            'reason' => 'required|min:5|max:1000'
        ]);
        $user = Auth::user();
        $rating = Rating::find($rating_id);
        //menginsert report ke tabel report
        Report::create([
            'reporter_id'=>$user->id,
            'target_id'=>$id,
            'product_id'=>$rating->product_id,
            'reason'=>$request->reason,
            'rating_id'=>$rating_id,
        ]);
        return redirect()->route('get.review');
    }
}