<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable =[
        "transaction_id",
        "product_id",
        "price",
        "quantity"
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
