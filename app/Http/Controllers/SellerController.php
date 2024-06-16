<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
return view('seller.index');
}

public function view_product()
{
    $data = Product::all();
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

    return redirect()->back()->with('toastr', 'Product added successfully');
} catch (\Exception $e) {
    Log::error('Product upload error: ' . $e->getMessage());
    return redirect()->back()->withErrors(['error' => 'There was an error uploading the product.']);
    }
    }
}