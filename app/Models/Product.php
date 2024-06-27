<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'seller_id',
        'name',
        'category_id',
        'stock',
        'quantity',
        'price',
        'description',
        'image',
        'date_added',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function ratings(){
        return $this->hasMany(Rating::class, 'product_id');
    }

    public function carts(){
        return $this->hasMany(Product::class, 'product_id');
    }
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

}
