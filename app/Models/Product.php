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
        'price',
        'description',
        'image',
    ];
}