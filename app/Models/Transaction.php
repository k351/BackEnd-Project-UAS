<?php

namespace App\Models;

use App\Models\TransactionItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'buy_history';

    protected $fillable =[
        "customer_id",
        "total",
        "transaction_date"
    ];
    public function users() {
        return $this->belongsTo(User::class);
    }

    public function transactionitems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
