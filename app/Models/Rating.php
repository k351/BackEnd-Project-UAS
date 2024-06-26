<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'product_id',
        'review',
        'rating',
        'transaction_id',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
    
}
