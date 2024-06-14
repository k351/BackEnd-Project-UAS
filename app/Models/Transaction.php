<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable =[
        "transaction_id",
        "customer_id",
        "product_id",
        "total",
        "transaction_date"
    ];

}
